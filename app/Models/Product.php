<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'products';

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
        'name',
        'slug',
        'price',
        'description',
        'stock',
        'category_id'
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
     * productCategory
     *
     * @return void
     */
    public function categories()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }


    /**
     * productGallery
     *
     * @return void
     */
    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'product_id', 'id');
    }

    /**
     * productSpecification
     *
     * @return void
     */
    public function specifications()
    {
        return $this->hasMany(ProductSpecification::class, 'product_id', 'id');
    }

    /**
     * oderDetail
     *
     * @return void
     */
    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }

}
