<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\User;


class Order extends Model

{

    use HasFactory;



    protected $table = 'orders';



    protected $primaryKey = 'id';



    protected $fillable = [

        'table_number',

        'staff_id',

        'user_id',

        'address_id',

        'subtotal',

        'subtotal',

        'shipping_discount',

        'shipping',

        'promo',

        'grandtotal',

        'content',

        'status',

    ];



    public $timestamps = true;



    public function orderItems(){

        return $this->hasMany(OrderItem::class,'order_id','id');

    }



    public function user(){

        return $this->belongsTo(User::class,'user_id','id');

    }

}

