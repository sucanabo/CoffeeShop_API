<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Model\Topping;
use App\Model\Product;

class ProductTopping extends Model
{
    use HasFactory;

    protected $table = 'product_toppings';

    protected $primaryKey = 'id';
    
    protected $fillable = ['product_id','topping_id','quantity',];
    
    public $timestamps = true;

    public function topping(){
        return $this->belongsTo(Topping::class,'topping_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
