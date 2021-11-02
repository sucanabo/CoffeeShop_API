<?php



namespace App\Models;



use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

use App\Models\Address;

use App\Models\Cart;

use App\Models\Rating;

use App\Models\Order;

use App\Models\UserReward;

use App\Models\Transaction;





class User extends Authenticatable

{

    use HasFactory, Notifiable, HasApiTokens;



    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'display_name',

        'gender',

        'birthday',

        'image',

        'address',

        'level' => 'integer',

        'point'=> 'integer',

        'qr_code',

        'status' => 'integer',

        'phone',

        'email',

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
        'point' => 'integer',
        'total_point' => 'integer',
        'level' => 'integer',
        'status' => 'integer',
    ];



    public function Orders(){

        return $this->hasMany(Order::class,'user_id','id');

    }



    public function Favourites(){

        return $this->hasMany('App\Models\Favourite','user_id','id');

    }



    public function UserRewards(){

        return $this->hasMany(UserReward::class,'user_id','id');

    }

    public function Address(){

        return $this->hasMany(Address::class,'user_id','id');

    }

    public function Transactions(){

        return $this->hasManys(Transaction::class,'user_id','id');

    }



    public function Cart(){

        return $this->hasManys(Cart::class,'user_id','id');

    }

    public function Rating(){

        return $this->belongsTo(Rating::class,'user_id','id');

    }

    

}

