<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $orders = OrderDetail::with(['order.user', 'product', 'order.payment'])
            ->whereHas('order', function ($query) {
                $query->orderBy('order_date', 'desc');
            })
            ->get();
        // dd($orders);
        return view('pages.admin.orders.index', compact('orders'));
    }

    /**
     * status_order
     *
     * @param  String $status
     * @return void
     */
    public function status_order(String $status)
    {
        $orders = OrderDetail::with(['order.user', 'product', 'order.payment'])
            ->whereHas('order', function ($query) use ($status) {
                $query->where('order_status', $status);
            })
            ->get();
        return view('pages.admin.orders.index', compact('orders'));
    }

    /**
     * order_detail
     *
     * @param  String $code
     * @return void
     */
    public function order_detail(String $code)
    {
        $order = OrderDetail::with(['order.user', 'product.productGallery', 'order.payment', 'orderDetailImage'])
            ->whereHas('order', function ($query) use ($code) {
                $query->where('order_code', $code);
            })
            ->firstOrFail();
        return view('pages.admin.orders.detail', compact('order'));
    }
}
