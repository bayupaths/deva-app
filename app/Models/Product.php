<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    protected $primaryKey = 'product_id';


    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'price', 'description', 'stock', 'category_id'];


    /**
     * productCategory
     *
     * @return void
     */
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }


    /**
     * productGallery
     *
     * @return void
     */
    public function productGallery()
    {
        return $this->hasMany(ProductGallery::class, 'product_id', 'product_id');
    }

    /**
     * productSpecification
     *
     * @return void
     */
    public function productSpecification()
    {
        return $this->hasMany(ProductSpecification::class, 'product_id', 'product_id');
    }

    /**
     * oderDetail
     *
     * @return void
     */
    public function oderDetail()
    {
        return $this->hasMany(OrderDetail::class, 'product_id', 'product_id');
    }

}
