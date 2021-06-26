<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOptions extends Model
{
    use HasFactory;

    protected $table = 'product_options';

    protected $primaryKey = 'id';
    
    protected $fillable = ['product_id','option_id','value',];
    
    public $timestamps = true;

    public function Options(){
        return $this->belongsTo('App\Models\Options','option_id','id');
    }

    public function Product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
