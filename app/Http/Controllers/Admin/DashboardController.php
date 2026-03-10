<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\TripDeparture;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Order Stats
        $totalOrders = Order::count();
        $pendingOrders = Order::where('status', 'pending')->count();
        $paidOrders = Order::where('status', 'paid')->count();
        $recentOrders = Order::with(['user', 'departure.tripTemplate'])
                            ->orderBy('created_at', 'desc')
                            ->take(6)
                            ->get();

        // 2. Financial Stats (Paid or Completed)
        $totalRevenue = Order::whereIn('status', ['paid', 'completed'])->sum('total_amount');

        // 3. User Stats
        $totalCustomers = User::where('role', 'user')->count();
        $newCustomersThisMonth = User::where('role', 'user')
                                     ->whereMonth('created_at', now()->month)
                                     ->count();

        // 4. Trip Stats
        $activeDepartures = TripDeparture::where('status', 'available')
                                         ->where('start_date', '>=', now())
                                         ->count();

        return view('admin.dashboard', compact(
            'totalOrders', 
            'pendingOrders', 
            'paidOrders', 
            'totalRevenue', 
            'totalCustomers', 
            'newCustomersThisMonth',
            'activeDepartures',
            'recentOrders'
        ));
    }
}
