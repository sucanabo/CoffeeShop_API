<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Topping;
use App\Models\Product;

class ProductOption extends Model
{
    use HasFactory;

    protected $table = 'product_options';

    protected $primaryKey = 'id';
    
    protected $fillable = ['product_id','option_id','title','price','default','status'];
    
    public $timestamps = true;

    public function option(){
        return $this->belongTo(Option::class,'option_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
