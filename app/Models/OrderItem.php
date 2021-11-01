<?php



namespace App\Models;



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



    public function Product(){

        return $this->belongsTo('App\Models\Product','product_id','id');

    }



    public function Order(){

        return $this->belongsTo('App\Models\Order','order_id','id');

    }

}

