<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Invoice extends Model
{
    use HasFactory;

    /**
     * table payments
     *
     * @var string
     */
    protected $table = 'invoices';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'order_id',
        'invoice_number',
        'invoice_date',
        'due_date',
        'total_amount',
        'status',
        'payment_method',
        'payment_date',
        'payment_amount'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
        });

        static::creating(function ($invoice) {
            $invoice->invoice_number = static::generateInvoiceNumber();
        });
    }

    private static function generateInvoiceNumber()
    {
        $year = substr(date('Y'), -2);
        $month = date('m');
        $day = date('d');

        $lastInvoice = self::latest()->first();

        if ($lastInvoice) {
            // Jika sudah ada invoice sebelumnya
            $lastInvoiceNumber = $lastInvoice->invoice_number;

            // Ambil urutan nomor dari invoice terakhir dan tambahkan 1
            $nextNumber = (int)substr($lastInvoiceNumber, -3) + 1;
        } else {
            // Jika ini invoice pertama
            $nextNumber = 1;
        }

        $invoiceNumber = $year . $month . $day . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        return $invoiceNumber;
    }

    /**
     * orders
     *
     * @return void
     */
    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * payments
     *
     * @return void
     */
    public function payments()
    {
        return $this->hasMany(Payment::class, 'invoice_id', 'id');
    }
}
