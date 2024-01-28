<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class ContactUs extends Model
{
    use HasFactory;

    /**
     * table
     *
     * @var string
     */
    protected $table = 'contact_us';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'phone_number',
        'email_address',
        'address',
        'location_map',
        'provinces_id',
        'regencies_id',
        'zip_code',
        'country',
        'office_hours'
    ];

    /**
     *
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
}
