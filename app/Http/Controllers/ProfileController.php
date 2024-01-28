<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\OrderDetail;

use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $customer = User::findOrFail($user->id);
        $orders = OrderDetail::with(['orders.users', 'products', 'orders.invoices'])
            ->whereHas('orders.users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        $invoice = Invoice::with(['orders.users'])->whereHas('orders.users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        return view('pages.customers.histories', [
            'customer' => $customer,
            'orders' => $orders,
            'countOrders' => count($orders),
            'countInvoice' => $invoice
        ]);
    }


    public function histories()
    {
        $user = Auth::user();
        $orders = OrderDetail::with(['orders.users', 'products', 'orders.invoices'])
            ->whereHas('orders.users', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
        $invoice = Invoice::with(['orders.users'])->whereHas('orders.users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        return view('pages.customers.histories', [
            'orders' => $orders,
            'countOrders' => count($orders),
            'countInvoice' => $invoice
        ]);
    }

    public function invoices()
    {
        $user = Auth::user();
        $invoices = Invoice::with(['orders.users'])->whereHas('orders.users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        $orders = Order::with(['users'])->whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();

        return view('pages.customers.invoices', [
            'invoices' => $invoices,
            'orders' => $orders,
        ]);
    }
}
