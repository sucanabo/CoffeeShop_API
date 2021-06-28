<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\ProductOption;
use App\Models\ProductVoucher;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\Rating;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $primaryKey = 'id';
    
    protected $fillable = 
    [
        'category_id',
        'title',
        'type',
        'price',
        'image',
        'content',
        'status'
    ];
    protected $appends = [
        'avgRating'
    ];

    public $timestamps = true;


    public function productOptions(){
        return $this->hasMany(ProductOption::class,'product_id','id');
    }

    public function productVouchers(){
        return $this->hasMany(ProductVoucher::class,'product_id','id');
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class,'product_id','id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

    public function ratings(){
        return $this->hasMany(Rating::class,'product_id','id');
    }
    public function getAvgRatingAttribute(){
        return round($this->ratings()->avg('star'),1);
    }
}
