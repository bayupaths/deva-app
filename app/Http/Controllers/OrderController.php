<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function create(Request $request, $slugProduct)
    {

        $product = Product::with(['categories', 'galleries', 'specifications'])
            ->where('slug', $slugProduct)->firstOr();
        return view('pages.customers.order', [
            'product' => $product,
            'request' => $request
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'order_note' => 'nullable|string|max:255',
                'product_price' => 'required|numeric|min:0',
                'total_price' => 'required|numeric|min:0',
                'product_quantity' => 'required|integer|min:1',
                'product_id' => 'required|exists:products,id',
                // 'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'order_note.max' => 'Order note tidak boleh melebihi 255 karakter.',
                'product_price.min' => 'Harga produk tidak boleh kurang dari 0.',
                'total_price.min' => 'Total harga tidak boleh kurang dari 0.',
                'product_quantity.min' => 'Jumlah produk tidak boleh kurang dari 1.',
                'product_id.exists' => 'Produk dengan ID yang dipilih tidak ditemukan.',
                // 'images.image' => 'File harus berupa gambar.',
                // 'images.mimes' => 'Format file harus jpeg, png, jpg, atau gif.',
                // 'images.max' => 'Ukuran file gambar tidak boleh lebih dari 2 MB.',
            ]);

            $order = Order::create([
                'admin_id' => null,
                'user_id' => Auth::user()->id,
                'total_price' => $request->total_price,
                'order_note' => $request->order_note
            ]);

            $orderDetail = OrderDetail::create([
                'product_id' => $request->product_id,
                'order_id' => $order->id,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'subtotal' => $request->product_price * $request->product_quantity,
                'product_note' => null,
            ]);

            $specs = $request->input('specs');
            foreach ($specs as $spec) {
                $specDetail =  \App\Models\OrderedDetailSpecifications::create([
                    'spec_id' => $spec,
                    'order_detail_id' => $orderDetail->id
                ]);
            }

            if ($request->hasFile('images')) {
                $imagePath = $request->file('images')->store('images', 'public');
                $orderDetailImage = new \App\Models\OrderDetailImage();
                $orderDetailImage->order_detail_id = $orderDetail->id;
                $orderDetailImage->image_path = $imagePath;
                $orderDetailImage->save();
            }

            return redirect()->route('order.detail', $order->order_code);
        } catch (\Exception $e) {
            echo "Error " . $e->getMessage();
        }
    }

    public function detail_order($code)
    {
        $order = OrderDetail::with([
            'orders.users',
            'products.galleries',
            'orders.invoices',
            'ordered_images'
        ])->whereHas('orders', function ($query) use ($code) {
            $query->where('order_code', $code);
        })->firstOrFail();

        return view('pages.customers.detail-order', [
            'item' => $order
        ]);
    }

    public function success($invoice)
    {
        $item = \App\Models\Invoice::where('invoice_number', $invoice)->firstOrFail();
        return view('pages.customers.success', compact('item'));
    }
}
