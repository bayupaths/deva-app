<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'phone_number', 'email_address', 'address',
        'location_map', 'provinces_id', 'regencies_id',
        'zip_code', 'country', 'office_hours'
    ];
}
