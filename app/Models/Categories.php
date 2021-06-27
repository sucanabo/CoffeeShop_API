<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'id';
    
    protected $fillable = ['title','status'];
    
    public $timestamps = true;

    public function product(){
        return $this->hasMany('App\Models\product','category_id','id');
    }

    public function CategoryVouchers(){
        return $this->hasMany('App\Models\CategoryVoucher','category_id','id');
    }
}
