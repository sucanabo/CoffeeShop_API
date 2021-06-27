<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $table = 'rewards';

    protected $primaryKey = 'id';

    protected $fillable = [
        'product_id',
        'user_id',
        'star',
    ];

    public $timestamps = true;

    public function User(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
    public function Product(){
        return $this->belongsTo('App\Models\Product','product_id','id');
    }
}
