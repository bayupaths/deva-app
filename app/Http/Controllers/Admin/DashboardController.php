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
        $totalRevenue = Payment::sum('payement_amount');
        $totalCustomer = User::count();
        $totalOrder = Order::count();

        $revenueThisWeek = Order::where('created_at', '>=', $lastWeek)->sum('total_price');
        if($totalRevenue != 0) {
            $precentageRevenue = ($revenueThisWeek / $totalRevenue) * 100;
        } else {
            $precentageRevenue = 0;
        }

        $recentOrders =  OrderDetail::with(['order.user'])->latest()->take(5)->get();
        $recentPayments = Payment::with(['order.user'])->latest()->take(5)->get();

        return view('pages.admin.dashboard.index', [
            'recentOrders' => $recentOrders,
            'recentPayments' => $recentPayments
        ]);
    }
}
