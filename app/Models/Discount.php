<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
    protected $table = 'discounts';

    protected $primaryKey = 'id';
    
    protected $fillable = 
    [
        'discount',
        'products',
        'start_date',
        'expiry_date',
    ];
    protected $casts = [
        'id' => 'integer',
        'discount' => 'integer',
    ];
}
