<?php



namespace App\Models;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\DB;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class OrderItem extends Model

{

    use HasFactory;



    protected $table = 'order_items';



    protected $primaryKey = 'id';



    protected $fillable = [

        'product_id',

        'order_id',

        'quantity',

        'price',

        'content',
        
        'item_detail',



    ];

    public $timestamps = true;

    protected $casts = [
        'order_id' => 'integer',
        'quantity' => 'integer',
    ];

    public function product(){

        return $this->belongsTo(Product:: class,'product_id','id');

    }
    public function order(){

        return $this->belongsTo(Order::class,'order_id','id');

    }

}

