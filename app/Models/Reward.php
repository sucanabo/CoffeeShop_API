<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    use HasFactory;

    protected $table = 'rewards';

    protected $primaryKey = 'id';

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

    public $timestamps = true;

    public function UserRewards(){
        return $this->hasMany('App\Models\UserRewards','reward_id','id');
    }
}
