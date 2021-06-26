<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'options';

    protected $primaryKey = 'id';
    
    protected $fillable = ['title','price','status'];
    
    public $timestamps = true;
}
