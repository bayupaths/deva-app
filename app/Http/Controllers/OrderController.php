<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $product = Product::with([
            'productCategory', 'productGallery', 'productSpecification'
        ])->where('slug', $request->product)->firstOrFail();

        return view('pages.customers.order');
    }


    public function store(Request $request)
    {
        $customer = Auth::user();

        $order = Order::create([
            'admin_id' => null,
            'user_id' => $customer->customer_id,
            'total_price' => $request->total_price,
            'order_note' => $request->order_note
        ]);

        $orderDetail = OrderDetail::create([
            'product_id' => $request->product_id,
            'order_id' => $order->order_id,
            'product_price' => $request->product_price,
            'product_quantity' => $request->product_quantity,
            'subtotal' => $request->product_price * $request->product_quantity,
            'product_note' => null,
        ]);

        // $detailSpec =


    }
}
