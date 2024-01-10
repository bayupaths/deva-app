<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderedDetailSpecifications extends Model
{

    /**
     * table
     *
     * @var string
     */
    public $table = 'ordered_detail_specifications';

    /**
     * primaryKey
     *
     * @var string
     */
    protected $primaryKey = 'ordered_spec_id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;


    /**
     * fillable
     *
     * @var array
     */
    public $fillable = [
        'spec_id',
        'order_detail_id'
    ];

    /**
     * productSpec
     *
     * @return void
     */
    public function productSpec()
    {
        return $this->belongsTo(ProductSpecification::class);
    }

    /**
     * OrderDetail
     *
     * @return void
     */
    public function OrderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
