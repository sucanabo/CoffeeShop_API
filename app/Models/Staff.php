<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staffs';

    protected $primaryKey = 'id';
    
    protected $fillable = 
    ['username',
    'password',
    'first_name',
    'last_name',
    'gender',
    'birthday',
    'image',
    'phone',
    'email',
    'role_id',
    'status'];
    
    public $timestamps = true;

    public function Role(){
        return $this->belongsTo('App\Models\Role','role_id','id');
    }

    public function Transactions(){
        return $this->hasMany('App\Models\Transaction','staff_id','id');
    }
}
