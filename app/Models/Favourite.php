<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    use HasFactory;

    protected $table = 'favourites';

    protected $primaryKey = 'id';
    
    protected $fillable = ['id','product_id','user_id'];
    
    public $timestamps = true;

    public function User(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function Product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
