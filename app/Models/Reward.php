<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'content',
        'image',
        'start_date',
        'expiry_date',
        'point',
        'content',
        'status',
    ];
}
