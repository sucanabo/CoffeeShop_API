<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topping;
use App\Models\Product;

class ProductTopping extends Model
{
    use HasFactory;

    protected $table = 'product_toppings';

    protected $primaryKey = 'id';
    
    protected $fillable = ['product_id','topping_id','status',];
    
    public $timestamps = true;
    protected $casts = [
        'product_id' => 'integer',
        'topping_id' => 'integer',
        'status' => 'integer',
    ];
    public function topping(){
        return $this->belongsTo(Topping::class,'topping_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
