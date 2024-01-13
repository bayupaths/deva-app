<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $customer = User::where(['user_id' => $user->user_id])->firstOrFail();
        $orders = OrderDetail::with(['order.user', 'product', 'order.payment'])
            ->whereHas('order.user', function ($query) use ($user) {
                $query->where('user_id', $user->user_id);
            })->get();
        return view('pages.customers.profile', [
            'customer' => $customer,
            'orders' => $orders
        ]);
    }
}
