<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasFactory;

    /**
     * primaryKey
     *
     * @var string
     */
    protected $primaryKey = 'admin_id';

    /**
     * fillable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'phone_number',
        'photos',
        'roles',
        'password',
    ];

    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * isAdmin
     *
     * @return void
     */
    public function isAdmin()
    {
        return $this->roles === 'ADMIN';
    }

    /**
     * isOwner
     *
     * @return void
     */
    public function isOwner()
    {
        return $this->roles === 'OWNER';
    }

    /**
     * order
     *
     * @return void
     */
    public function order()
    {
        return $this->hasMany(Order::class, 'admin_id', 'admin_id');
    }
}
