<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'id';
    
    protected $fillable = ['title','status'];
    
    public $timestamps = true;
    protected $casts = [
        'status' => 'integer',
    ];
    public function Products(){
        return $this->hasMany('App\Models\Product','category_id','id');
    }

    public function CategoryVouchers(){
        return $this->hasMany('App\Models\CategoryVoucher','category_id','id');
    }
}
