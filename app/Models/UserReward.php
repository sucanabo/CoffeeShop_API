<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReward extends Model
{
    use HasFactory;

    protected $table = 'user_rewards';

    protected $primaryKey = 'id';

    protected $fillable = [
        'reward_id',
        'user_id',
        'quantity',
        'status',
    ];
    
    public $timestamps = true;


    public function Reward(){
        return $this->belongsTo('App\Models\Reward','reward_id','id');
    }

    public function User(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
