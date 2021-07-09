<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';
    
    protected $fillable = 
    [
    'category_id',
    'title','type',
    'price',
    'image',
    'content',
    'status'
    ];
    
    public $timestamps = true;


    public function productOptions(){
        return $this->hasMany('App\Models\ProductOption','product_id','id');
    }

    public function Favourites(){
        return $this->hasMany('App\Models\Favourite','product_id','id');
    }

    public function productVouchers(){
        return $this->hasMany('App\Models\ProductVoucher','product_id','id');
    }

    public function orderitems(){
        return $this->hasMany('App\Models\OrderItem','product_id','id');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function ratings(){
        return $this->hasMany('App\Models\Rating','product_id','id');
    }
    public function avgRating(){
        return $this->ratings->select('*', DB::raw('AVG(star) as avg_rating'));
    }
}
