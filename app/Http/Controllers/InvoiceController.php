<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Invoice;
use App\Models\OrderDetail;

use PDF;

class InvoiceController extends Controller
{

    public function index()
    {
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'payment_method' => 'required|in:cash,transfer',
        ]);

        $invoice = Invoice::create([
            'order_id' => $request->order_id,
            'invoice_date' => now(),
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
        ]);

        if ($invoice) {
            return redirect()->route('order.success', $invoice->invoice_number);
        } else {
            return redirect()->back();
        }
    }

    public function show($code)
    {
        $user = Auth::user();
        $invoice = Invoice::with(['orders.users', 'payments'])->where('invoice_number', $code)->firstOr();
        $items =  OrderDetail::with(['products'])->where('order_id', $invoice->order_id)->firstOr();

        // dd($invoice);
        return view('pages.customers.detail-invoice', [
            'invoice' => $invoice,
            'items' => $items
        ]);
    }

    public function print($code)
    {
        $invoice = Invoice::with(['orders.users', 'payments'])->where('invoice_number', $code)->firstOr();
        $items =  OrderDetail::with(['products'])->where('order_id', $invoice->order_id)->firstOr();
        $data = [
            'invoice' => $invoice,
            'items' => $items,
        ];
        $nameFileDocuments = $invoice->invoice_number . '.pdf';

        // Generate PDF
        $document = PDF::loadView('pdf.invoice', $data);
        $document->setPaper('A4', 'portrait');
        return $document->stream($nameFileDocuments);
    }
}
