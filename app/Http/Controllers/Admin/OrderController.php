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
        $orders = OrderDetail::with(['orders.users', 'products', 'orders.invoices'])
            ->whereHas('orders', function ($query) {
                $query->orderBy('order_date', 'desc');
            })
            ->get();
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
        $orders = OrderDetail::with(['orders.users', 'products', 'order.invoices'])
            ->whereHas('orders', function ($query) use ($status) {
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
        $order = OrderDetail::with([
            'orders.users',
            'products.galleries',
            'orders.invoices',
            'ordered_images'
        ])->whereHas('orders', function ($query) use ($code) {
            $query->where('order_code', $code);
        })->firstOrFail();

        return view('pages.admin.orders.detail', [
            'item' => $order,
        ]);
    }

    public function updateStatus(Request $request)
    {
        $orderId = $request->input('orderId');
        $orderStatus = $request->input('orderStatus');

        $order = \App\Models\Order::find($orderId);
        if ($order) {
            $order->order_status = $orderStatus;
            $order->save();
            return response()->json(['message' => 'Order status updated successfully']);
        } else {
            return response()->json(['message' => 'Order not found'], 404);
        }
    }
}
