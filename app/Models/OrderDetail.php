<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'order_details';

    /**
     * primaryKey
     *
     * @var string
     */
    protected $primaryKey = 'order_detail_id';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['product_id', 'order_id', 'product_price', 'product_quantity', 'subtotal', 'product_note'];

    /**
     * order
     *
     * @return void
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * product
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * productSpecification
     *
     * @return void
     */
    public function productSpecification()
    {
        return $this->belongsToMany(ProductSpecification::class, 'ordered_detail_specifications')
            ->using(OrderedDetailSpecifications::class);
    }

    /**
     * orderDetailImage
     *
     * @return void
     */
    public function orderDetailImage()
    {
        return $this->hasMany(OrderDetailImage::class, 'order_detail_id', 'order_detail_id');
    }
}
