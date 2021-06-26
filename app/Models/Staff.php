<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

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

    public function Roles(){
        return $this->belongsTo('App\Models\Roles','role_id','id');
    }

    public function Transaction(){
        return $this->hasMany('App\Models\Transaction','staff_id','id');
    }
}
