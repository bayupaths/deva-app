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
        $year = date('Y');
        $month = date('m');

        $count = static::whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->count() + 1;

        $invoiceNumber = sprintf('%s%s%04d', 'INV', now()->format('YmdHis'), $count);
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
