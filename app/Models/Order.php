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
    protected $fillable = ['order_code', 'order_date', 'total_price', 'order_note', 'order_status', 'user_id'];

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
