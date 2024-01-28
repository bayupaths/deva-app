<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;
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
    protected $primaryKey = 'id';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'product_price',
        'product_quantity',
        'subtotal',
        'product_note',
        'order_id',
        'product_id',
    ];

    /**
     * boot
     *
     * @return void
     */
    public static function boot()
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
    public function orders()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * product
     *
     * @return void
     */
    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * productSpecification
     *
     * @return void
     */
    public function specifications()
    {
        return $this->belongsToMany(ProductSpecification::class, 'ordered_detail_specifications', 'order_detail_id', 'spec_id');
    }

    /**
     * orderDetailImage
     *
     * @return void
     */
    public function ordered_images()
    {
        return $this->hasMany(OrderDetailImage::class, 'order_detail_id', 'id');
    }
}
