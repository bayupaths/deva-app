<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Ramsey\Uuid\Uuid;

class Admin extends Authenticatable
{
    use HasFactory;

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

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Uuid::uuid4();
        });
    }

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
    public function orders()
    {
        return $this->hasMany(Order::class, 'admin_id', 'id');
    }
}
