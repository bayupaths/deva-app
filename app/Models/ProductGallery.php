<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'product_galleries';

    /**
     * primaryKey
     *
     * @var string
     */
    protected $primaryKey = 'gallery_id';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['file_name', 'file_type', 'file_size', 'file_path', 'description', 'product_id'];

    /**
     * product
     *
     * @return void
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
