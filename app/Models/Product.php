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
}
