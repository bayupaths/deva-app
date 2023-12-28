<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $lastWeek = now()->subWeek();

        $totalSales = Order::sum('total_price');
        $totalRevenue = Payment::sum('payment_amount');
        $totalCustomer = User::count();
        $totalOrder = Order::count();


        $recentOrders =  OrderDetail::with(['order.user'])->latest()->take(5)->get();
        $recentPayments = Payment::with(['order.user'])->latest()->take(5)->get();

        return view('pages.admin.dashboard.index', [
            'totalSales' => $totalSales,
            'totalRevenue' => $totalRevenue,
            'totalCustomer' => $totalCustomer,
            'totalOrder' => $totalOrder,
            'recentOrders' => $recentOrders,
            'recentPayments' => $recentPayments
        ]);
    }
}
