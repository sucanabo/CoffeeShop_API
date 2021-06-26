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

}
