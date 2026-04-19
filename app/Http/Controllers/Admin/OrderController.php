<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\TripTemplate;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with(['user', 'departure.tripTemplate', 'variant'])
            ->orderBy('created_at', 'desc');

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by Booking Date Range
        if ($request->filled('booking_date_from')) {
            $query->whereDate('created_at', '>=', $request->booking_date_from);
        }
        if ($request->filled('booking_date_to')) {
            $query->whereDate('created_at', '<=', $request->booking_date_to);
        }

        // Filter by Trip Template ID and Departure
        if ($request->filled('trip_id')) {
            $tripId = $request->trip_id;
            if ($request->filled('departure_id')) {
                $query->where('departure_id', $request->departure_id);
            } else {
                $query->whereHas('departure', function($q) use ($tripId) {
                    $q->where('trip_template_id', $tripId);
                });
            }
        }

        // Filter by Search (Order Number or Customer Name)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhereHas('user', function($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $orders = $query->paginate(15)->withQueryString();
        
        // Fetch trips with their departures for filter dropdown
        $trips = TripTemplate::with(['departures' => function($q) {
            $q->orderBy('start_date', 'asc');
        }])->orderBy('title')->get(['id', 'title']);

        return view('admin.orders.index', compact('orders', 'trips'));
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'departure.tripTemplate', 'variant', 'items', 'addons']);
        return view('admin.orders.show', compact('order'));
    }

    /**
     * Cancel an order manually (optional admin action).
     */
    public function cancel(Order $order)
    {
        if ($order->status !== Order::STATUS_CANCELLED && $order->status !== Order::STATUS_PAID) {
            $order->update(['status' => Order::STATUS_CANCELLED]);
            return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan.');
        }

        return redirect()->back()->with('error', 'Pesanan ini tidak dapat dibatalkan.');
    }

    public function downloadInvoicePdf(Order $order)
    {
        $order->load(['user', 'departure.tripTemplate', 'variant', 'items', 'addons']);
        
        // Ensure admin only downloads paid orders if following business rules,
        // though admin technically could view any. Let's stick to 'paid'.
        if ($order->status !== 'paid') {
            return redirect()->back()->with('error', 'Invoice PDF hanya tersedia untuk pesanan yang sudah lunas (Paid).');
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.invoice', compact('order'));
        return $pdf->download('Invoice-' . $order->order_number . '.pdf');
    }
}
