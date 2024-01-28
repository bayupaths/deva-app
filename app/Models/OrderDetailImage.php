<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

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
    protected $primaryKey = 'id';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'description',
        'image_path',
        'order_detail_id',
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
     * orderDetail
     *
     * @return void
     */
    public function order_details()
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }
}
