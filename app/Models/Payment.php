<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Payment extends Model
{
    use HasFactory;

    /**
     * table payments
     *
     * @var string
     */
    protected $table = 'payments';

    /**
     * primaryKey payment_id
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'invoice_id',
        'payment_date',
        'payment_amount',
        'payment_method',
        'transaction_reference'
    ];

    /**
     * boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
        });
    }

    /**
     * order
     *
     * @return void
     */
    public function invoices()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
