<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';
    
    protected $fillable = 
    ['category_id',
    'title','type',
    'price',
    'image',
    'star',
    'content',
    'status'
    ];
    
    public $timestamps = true;


    public function ProductOptions(){
        return $this->hasMany('App\Models\ProductOptions','product_id','id');
    }

    public function ProductVouchers(){
        return $this->hasMany('App\Models\ProductVouchers','product_id','id');
    }

    public function OrderItem(){
        return $this->hasMany('App\Models\OrderItem','product_id','id');
    }

    public function Categories(){
        return $this->belongsTo('App\Models\Categories','category_id','id');
    }


   
}
