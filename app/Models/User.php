<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birthday',
        'avatar',
        'address',
        'level',
        'point',
        'qr_code',
        'status',
        'phone',
        'email',
        'username',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Order(){
        return $this->hasMany('App\Models\Order','user_id','id');
    }

    public function UserRewards(){
        return $this->hasMany('App\Models\UserRewards','user_id','id');
    }

    public function Transaction(){
        return $this->hasMany('App\Models\Transaction','user_id','id');
    }

    public function cart(){
        return $this->hasMany('App\Models\Cart','user_id','id');
    }
}
