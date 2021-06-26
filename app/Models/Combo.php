<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    use HasFactory;

    protected $table = 'combos';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'content',
        'image',
        'acture_price',
        'discount_price',
        'start_date',
        'expiry_date',
        'status',
    ];

    public $timestamps = true;
}
