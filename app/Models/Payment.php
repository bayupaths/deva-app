<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

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
    protected $primaryKey = 'payment_id';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'payment_code', 'payement_method', 'card_number',
        'cardholder_name', 'payement_date', 'payement_amount', 'payement_status'
    ];

    /**
     * order
     *
     * @return void
     */
    public function order()
    {
        $this->belongsTo(Order::class, 'order_id');
    }
}
