<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'admin',
        'group_id',
        'password',
//        'created_by',
        'created_at',
//        'updated_by',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function group ()
    {
        return $this->belongsTo(Group::class);
    }

    public function houses()
    {
        return $this->hasMany(House::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
