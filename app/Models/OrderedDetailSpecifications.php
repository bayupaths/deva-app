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
    protected $primaryKey = 'id';

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
    public function specifications()
    {
        return $this->belongsTo(ProductSpecification::class);
    }

    /**
     * OrderDetail
     *
     * @return void
     */
    public function order_details()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
