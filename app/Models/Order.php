<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * primaryKey
     *
     * @var string
     */
    protected $primaryKey = 'order_id';


    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['order_code', 'oder_number', 'order_date', 'total_price', 'order_note', 'order_status', 'user_id'];


    /**
     * boot
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->code_order = 'DEVA' . now()->format('Ymd') . static::generateOrderNumber();
            $order->order_number = $order->generateOrderNumber();
            $order->order_date = now();
            $order->order_status = 'PENDING';
        });
    }

    /**
     * generateOrderNumber
     *
     * @return void
     */
    protected static function generateOrderNumber()
    {
        $lastOrder = static::latest()->first();

        if ($lastOrder) {
            $lastOrderNumber = explode('DEV', $lastOrder->order_number);
            return str_pad((int)$lastOrderNumber[1] + 1, 4, '0', STR_PAD_LEFT);
        } else {
            return '0001';
        }
    }

    /**
     * user
     *
     * @return void
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * orderDetail
     *
     * @return void
     */
    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'order_id');
    }

    /**
     * payment
     *
     * @return void
     */
    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_id');
    }
}
