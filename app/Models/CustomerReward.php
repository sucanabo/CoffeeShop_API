<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerReward extends Model
{
    use HasFactory;
    protected $fillable = [
        'reward_id',
        'customer_id',
        'quantity',
        'status',
    ];
}
