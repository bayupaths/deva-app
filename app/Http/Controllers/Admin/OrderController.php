<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = OrderDetail::with(['order.user', 'product.productGallery'])
            ->whereHas('order', function ($query) {
                $query->orderBy('order_date', 'desc');
            })
            ->get();
            // dd($orders);
        return view('pages.admin.orders.index', compact('orders'));
    }

    public function procesed_order()
    {
        $procesedOrders = OrderDetail::with(['order.user', 'product.productGallery'])
            ->whereHas('order', function ($query) {
                $query->where('order_status', 'PROCESSED');
            })
            ->get();
        return view('pages.admin.orders.processed', compact('procesedOrders'));
    }

    public function finished_order()
    {
        $finisheddOrders = OrderDetail::with(['order.user', 'product.productGallery'])
            ->whereHas('order', function ($query) {
                $query->where('order_status', 'FINISHED');
            })
            ->get();
        return view('pages.admin.orders.finished',  compact('finisheddOrders'));
    }
}
