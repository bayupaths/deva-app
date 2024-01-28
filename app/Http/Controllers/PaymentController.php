<?php

namespace  App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;

use Midtrans\Snap;
use Midtrans\Config;
use Midtrans\Notification;

class PaymentController extends Controller
{

    /**
     * proses pembayaran dengan payment gateway midtrans
     *
     * @param  String $invoice_number
     * @return void
     */
    public function payment(String $invoice_number)
    {
        $invoice = Invoice::with(['orders.users'])->where('invoice_number', $invoice_number)->firstOrFail();
        $item = \App\Models\OrderDetail::with(['products.categories'])->where('order_id', $invoice->orders->id)->firstOr();
        // Configuration Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.id3ds');

        // produk
        $product = [
            'id' => $item->products->uuid,
            'price' => (int)$item->product_price,
            'quantity' => $item->product_quantity,
            'name' => $item->products->name,
            'category' => $item->products->categories->name,
            'type' => 'physical',
        ];

        // create array send to midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $invoice->invoice_number,
                'gross_amount' => (int)$invoice->total_amount
            ],
            'customer_details' => [
                'first_name' => $invoice->orders->users->name,
                'email' => $invoice->orders->users->email,
                'phone' => $invoice->orders->users->phone_number,
            ],
            'item_details' => array($product),
            'enabled_payments' => [
                'gopay', 'indomaret', 'bank_transfer'
            ],
            'vtweb' => []
        ];

        try {
            // Get Snap Payment Page URL
            $paymentUrl = Snap::createTransaction($midtrans)->redirect_url;

            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function callback(Request $request)
    {
        // Set konfigurasi midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.id3ds');

        // Instance midtrans notification
        $notification = new Notification();

        // Assign ke variable untuk memudahkan coding
        $status = $notification->notification_status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud_status;
        $payment_date = $notification->transaction_time;
        $amount = $notification->gross_amount;
        $order_id = $notification->order_id;

        // Cari transaksi berdasarkan ID
        $transaction = Invoice::where('invoice_number', $order_id)->firstOr();

        // Handle notification status
        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->status = 'PENDING';
                } else {
                    // update status invoices
                    $transaction->status = 'PAID';
                    $transaction->payment_date = $payment_date;
                    $transaction->payment_amount = $amount;

                    // simpan data pembayaran pada tabel payments
                    $payment = \App\Models\Payment::create([
                        'invoice_id' => $transaction->id,
                        'payment_date' => $payment_date,
                        'payment_amount' => $amount,
                        'payment_method' => $type . " ($notification->bank)",
                        'transaction_reference' => $notification->approval_code,
                    ]);
                }
            }
        } else if ($status == 'settlement') {
            // update status invoice
            $transaction->status = 'PAID';
            $transaction->payment_date = $payment_date;
            $transaction->payment_amount = $amount;

            // check payment method
            if ($type == 'bank_transfer') {
                $paymentType = $notification->payment_type . " (" . $notification->va_numbers[1]['va'] . ")";
                $transactionRef = $notification->va_numbers[0]['va_number'] ?? null;
            } else if ($type == 'cstore') {
                $paymentType = $notification->store;
                $transactionRef = $notification->payment_code;
            } else {
                $paymentType = $type;
                $transactionRef = null;
            }

            // simpan data pembayaran pada tabel payments
            $payment = \App\Models\Payment::create([
                'invoice_id' => $transaction->id,
                'payment_date' => $payment_date,
                'payment_amount' => $amount,
                'payment_method' => $paymentType,
                'transaction_reference' => $transactionRef,
            ]);
        } else if ($status == 'pending') {
            $transaction->status = 'PENDING';
        } else if ($status == 'deny') {
            $transaction->status = 'CANCELED';
        } else if ($status == 'expire') {
            $transaction->status = 'CANCELED';
        } else if ($status == 'cancle') {
            $transaction->status = 'CANCELED';
        }

        // Simpan transaksi
        $transaction->save();
    }
}