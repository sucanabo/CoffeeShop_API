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
    'content',
    'status'
    ];
    
    public $timestamps = true;


    public function ProductOption(){
        return $this->hasMany('App\Models\ProductOption','product_id','id');
    }

    public function ProductVoucher(){
        return $this->hasMany('App\Models\ProductVoucher','product_id','id');
    }

    public function OrderItem(){
        return $this->hasMany('App\Models\OrderItem','product_id','id');
    }

    public function Category(){
        return $this->belongsTo('App\Models\Category','category_id','id');
    }

    public function Rating(){
        return $this->hasMany('App\Models\Rating','product','id');
    }
}
