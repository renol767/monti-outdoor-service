<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TripDeparture;
use App\Models\DepartureVariant;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function show(TripDeparture $departure, DepartureVariant $variant)
    {
        Log::info('Checkout show accessed', [
            'user_id' => auth()->id(),
            'departure_id' => $departure->id,
            'variant_id' => $variant->id,
            'variant_departure_id' => $variant->departure_id
        ]);

        // Ensure the variant belongs to the departure
        if ($variant->departure_id !== $departure->id) {
            Log::warning('Checkout show aborted 404 due to mismatch', [
                'departure_id' => $departure->id,
                'variant_departure_id' => $variant->departure_id
            ]);
            abort(404);
        }

        // Get Addons that are active
        $addons = $departure->addons()->where('is_active', true)->get();

        return view('checkout.index', compact('departure', 'variant', 'addons'));
    }

    public function process(Request $request, TripDeparture $departure, DepartureVariant $variant)
    {
        // Validate request
        $validated = $request->validate([
            'pax' => 'required|integer|min:1',
            'participants' => 'required|array|min:1',
            'participants.*.name' => 'required|string|max:255',
            'participants.*.phone' => 'nullable|string|max:20',
            'participants.*.email' => 'nullable|email|max:255',
            'participants.*.id_number' => 'nullable|string|max:50',
            'addons' => 'nullable|array',
            'addons.*.id' => 'required|exists:departure_addons,id',
            'addons.*.quantity' => 'required|integer|min:1',
        ]);

        // Begin transaction
        try {
            DB::beginTransaction();

            $pax = $validated['pax'];
            
            // Calculate prices
            $basePrice = $variant->base_price * $pax;
            $discount = ($variant->calculated_discount ?: $departure->calculated_discount) * $pax;
            $subtotal = $basePrice;

            // Handle Addons
            $addonsTotal = 0;
            $orderAddons = [];
            
            if (!empty($validated['addons'])) {
                foreach ($validated['addons'] as $addonInput) {
                    $addon = $departure->addons()->find($addonInput['id']);
                    if ($addon) {
                        $qty = $addonInput['quantity'];
                        $itemTotal = $addon->price * $qty;
                        $addonsTotal += $itemTotal;

                        $orderAddons[] = [
                            'departure_addon_id' => $addon->id,
                            'addon_name' => collect([$addon->addon->name, $addon->description])->filter()->implode(' - '),
                            'unit_price' => $addon->price,
                            'quantity' => $qty,
                            'total_price' => $itemTotal,
                        ];
                    }
                }
            }

            $totalAmount = ($subtotal - $discount) + $addonsTotal;

            // Create Order
            $order = Order::create([
                'user_id' => auth()->id(),
                'departure_id' => $departure->id,
                'variant_id' => $variant->id,
                'pax_count' => $pax,
                'subtotal' => $subtotal,
                'discount_amount' => $discount,
                'addons_total' => $addonsTotal,
                'total_amount' => $totalAmount,
                'status' => Order::STATUS_PENDING,
            ]);

            // Create Order Participants/Items
            foreach ($validated['participants'] as $participant) {
                $order->items()->create([
                    'participant_name' => $participant['name'],
                    'participant_phone' => $participant['phone'] ?? null,
                    'participant_email' => $participant['email'] ?? null,
                    'participant_id_number' => $participant['id_number'] ?? null,
                ]);
            }

            // Create Order Addons
            foreach ($orderAddons as $orderAddon) {
                $order->addons()->create($orderAddon);
            }

            // Generate Midtrans Snap Token
            $customerDetails = [
                'first_name' => auth()->user()->name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone ?? '',
            ];

            // Setup transaction details
            $transaction_details = [
                'order_id' => $order->order_number,
                'gross_amount' => $totalAmount,
            ];

            // Optional: item details
            $item_details = [];
            // Variant Item
            $item_details[] = [
                'id' => 'VAR-' . $variant->id,
                'price' => $variant->base_price - ($variant->calculated_discount ?: $departure->calculated_discount),
                'quantity' => $pax,
                'name' => limit_string($variant->name . ' - ' . $departure->tripTemplate->title, 50)
            ];

            // Addons Item
            foreach ($orderAddons as $oa) {
                $item_details[] = [
                    'id' => 'ADD-' . $oa['departure_addon_id'],
                    'price' => $oa['unit_price'],
                    'quantity' => $oa['quantity'],
                    'name' => limit_string($oa['addon_name'], 50)
                ];
            }

            $params = [
                'transaction_details' => $transaction_details,
                'customer_details' => $customerDetails,
                'item_details' => $item_details,
                'callbacks' => [
                    'finish' => route('user.transaction'),
                    'error' => route('user.transaction'),
                    'pending' => route('user.invoice')
                ]
            ];

            try {
                $snapToken = Snap::getSnapToken($params);
                $order->update(['notes' => $snapToken]); // Temporary store snap token in notes
            } catch (\Exception $e) {
                DB::rollBack();
                return back()->with('error', 'Payment gateway error: ' . $e->getMessage())->withInput();
            }

            DB::commit();

            return redirect()->route('checkout.invoice', $order->order_number);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage())->withInput();
        }
    }

    public function invoice(string $orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
                      ->where('user_id', auth()->id())
                      ->with(['departure.tripTemplate', 'variant', 'items', 'addons'])
                      ->firstOrFail();

        $snapToken = $order->notes; // Get stored snap token

        return view('checkout.invoice', compact('order', 'snapToken'));
    }
}

function limit_string($string, $limit) {
    if (strlen($string) > $limit) {
        return substr($string, 0, $limit);
    }
    return $string;
}
