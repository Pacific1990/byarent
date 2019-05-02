<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'picture',
        'rent',
        'price',
        'user_id',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }

    public function files ()
    {
        return $this->hasMany(File::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
