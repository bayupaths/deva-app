<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $transactions = Order::with(['user', 'payment']);
        return view('pages.admin.transactions.index', compact('transactions'));
    }

    public function detail($code)
    {
        $paymentCode = $code;
        $transaction = Order::with(['user', 'payment'])
            ->whereHas('payment', function ($query) use ($paymentCode) {
                $query->where('payment_code', $paymentCode);
            })->firstOrFail();
        return view('pages.admin.transactions.detail', compact('transaction'));

    }
}
