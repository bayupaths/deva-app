<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailImage extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'ordered_detail_images';

    /**
     * primaryKey
     *
     * @var string
     */
    protected $primaryKey = 'ordered_image_id';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = ['order_detail_id', 'description', 'image_path'];

    /**
     * orderDetail
     *
     * @return void
     */
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }
}
