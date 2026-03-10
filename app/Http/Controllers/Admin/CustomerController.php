<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of customers.
     */
    public function index(Request $request)
    {
        // Get users with role 'user', counting their orders and summing total spent
        $query = User::where('role', 'user')
            ->withCount(['orders' => function($q) {
                $q->whereIn('status', ['paid', 'completed']);
            }])
            ->withSum(['orders as total_spent' => function($q) {
                $q->whereIn('status', ['paid', 'completed']);
            }], 'total_amount')
            ->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $customers = $query->paginate(15)->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    /**
     * Display the specified customer and their order history.
     */
    public function show(User $customer)
    {
        // Ensure only showing 'user' roles
        if ($customer->role !== 'user') {
            abort(404);
        }

        // Get their order history
        $orders = $customer->orders()
            ->with(['departure.tripTemplate'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        // Calculate metrics
        $metrics = [
            'total_orders' => $customer->orders()->whereIn('status', ['paid', 'completed'])->count(),
            'total_spent' => $customer->orders()->whereIn('status', ['paid', 'completed'])->sum('total_amount'),
            'cancelled_orders' => $customer->orders()->whereIn('status', ['cancelled'])->count(),
        ];

        return view('admin.customers.show', compact('customer', 'orders', 'metrics'));
    }
}
