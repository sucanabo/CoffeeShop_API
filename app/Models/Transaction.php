<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'order_id',
        'delivery_method',
        'code',
        'type',
        'mode',
        'status',
        'content'
    ];
    
    public $timestamps = true;

    public function User(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function Staff(){
        return $this->belongsTo('App\Models\Staff','staff_id','id');
    }
    public function order(){
        return $this->belongsTo(Order::class,'order_id','id');
    }
}
