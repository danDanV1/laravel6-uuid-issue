<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Dyrynda\Database\Support\GeneratesUuid;

class User extends Authenticatable
{
    use Notifiable, GeneratesUuid;

    public $incrementing = false;

    protected $casts = ['id' => 'uuid', 'email_verified_at' => 'datetime',];

    public function uuidColumn(): string
    {
        return 'id';
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
