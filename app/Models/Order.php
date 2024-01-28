<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

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
    protected $primaryKey = 'id';


    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'order_code',
        'oder_number',
        'order_date',
        'total_price',
        'order_note',
        'order_status',
        'user_id',
        'admin_id'
    ];


    /**
     * boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_code = 'DEVA' . now()->format('YmdHis') . static::generateOrderNumber();
            $order->order_number = $order->generateOrderNumber();
            $order->order_date = now();
            $order->order_status = 'PENDING';
        });

        static::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
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
            $lastOrderNumber = $lastOrder->order_number;
            $newNumber = str_pad((int)$lastOrderNumber + 1, 4, '0', STR_PAD_LEFT);

            // Check if the new order number already exists
            while (static::where('order_number', $newNumber)->exists()) {
                $newNumber = str_pad((int)$newNumber + 1, 4, '0', STR_PAD_LEFT);
            }

            return $newNumber;
        } else {
            return '0001';
        }
    }


    /**
     * user
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * admins
     *
     * @return void
     */
    public function admins()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    /**
     * orderDetail
     *
     * @return void
     */
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    /**
     * payment
     *
     * @return void
     */
    public function invoices()
    {
        return $this->hasOne(Invoice::class, 'order_id');
    }
}
