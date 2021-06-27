<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    protected $primaryKey = 'id';

    protected $fillable = [
        'customer_id',
        'order_id',
        'code',
        'type',
        'mode',
        'status',
        'content',
    ];
    
    public $timestamps = true;

    public function User(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function Staff(){
        return $this->belongsTo('App\Models\Staff','staff_id','id');
    }
}
