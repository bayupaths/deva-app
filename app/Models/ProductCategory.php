<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductCategory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'product_categories';

    /**
     * primaryKey
     *
     * @var string
     */
    protected $primaryKey = 'category_id';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'subcategories', 'image'];

    /**
     * product
     *
     * @return void
     */
    public function product()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
