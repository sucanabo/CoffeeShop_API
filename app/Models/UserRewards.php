<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRewards extends Model
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


    public function Rewards(){
        return $this->belongsTo('App\Models\Rewards','reward_id','id');
    }

    public function User(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }
}
