<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Notification;

class WebhookController extends Controller
{
    public function __construct()
    {
        // Set Midtrans configuration
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
    }

    public function midtrans(Request $request)
    {
        try {
            $notification = new Notification();

            $transactionStatus = $notification->transaction_status;
            $orderId = $notification->order_id;
            $paymentType = $notification->payment_type;
            
            $order = Order::where('order_number', $orderId)->first();

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            // Validating signature key to ensure request is from Midtrans
            $serverKey = config('midtrans.server_key');
            $signatureKey = hash("sha512", $notification->order_id . $notification->status_code . $notification->gross_amount . $serverKey);
            
            if ($signatureKey !== $notification->signature_key) {
                return response()->json(['message' => 'Invalid signature'], 403);
            }

            if ($transactionStatus == 'capture') {
                if ($paymentType == 'credit_card') {
                    if ($notification->fraud_status == 'challenge') {
                        $order->update(['status' => Order::STATUS_PENDING]);
                    } else {
                        if ($order->status !== Order::STATUS_PAID) {
                            $order->update([
                                'status' => Order::STATUS_PAID,
                                'paid_at' => now(),
                                'payment_method' => $paymentType
                            ]);
                            $order->departure()->increment('booked_count', $order->pax_count);
                            $order->variant()->increment('booked_count', $order->pax_count);
                        }
                    }
                }
            } else if ($transactionStatus == 'settlement') {
                if ($order->status !== Order::STATUS_PAID) {
                    $order->update([
                        'status' => Order::STATUS_PAID,
                        'paid_at' => now(),
                        'payment_method' => $paymentType
                    ]);
                    $order->departure()->increment('booked_count', $order->pax_count);
                    $order->variant()->increment('booked_count', $order->pax_count);
                }
            } else if ($transactionStatus == 'pending') {
                $order->update(['status' => Order::STATUS_PENDING]);
            } else if ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
                if ($order->status === Order::STATUS_PAID) { // Restore quota if it was already paid
                     $order->departure()->decrement('booked_count', $order->pax_count);
                     $order->variant()->decrement('booked_count', $order->pax_count);
                }
                $order->update(['status' => Order::STATUS_CANCELLED]);
            } else if ($transactionStatus == 'refund' || $transactionStatus == 'partial_refund') {
                if ($order->status === Order::STATUS_PAID) {
                     $order->departure()->decrement('booked_count', $order->pax_count);
                     $order->variant()->decrement('booked_count', $order->pax_count);
                }
                $order->update(['status' => Order::STATUS_REFUNDED]);
            }

            return response()->json(['message' => 'Success']);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
