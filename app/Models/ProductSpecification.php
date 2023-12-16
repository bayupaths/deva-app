<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSpecification extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'product_specifications';

    /**
     * primaryKey
     *
     * @var string
     */
    protected $primaryKey = 'spec_id';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['spec_type', 'spec_value', 'unit', 'description', 'product_id'];

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
     * orderDetail
     *
     * @return void
     */
    public function orderDetail()
    {
        return $this->belongsToMany(OrderDetail::class, 'ordered_detail_specifications')
            ->using(OrderedDetailSpecifications::class);
    }
}
