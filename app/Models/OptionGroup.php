<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Option;

class OptionGroup extends Model
{
    use HasFactory;

    protected $table = 'option_groups';

    protected $primaryKey = 'id';
    
    protected $fillable = ['title','status'];
    
    public $timestamps = true;
    protected $casts = [
        'status' => 'integer'
    ];
    public function options(){
        return $this->hasMany(Option::class,'option_group_id','id');
    }
}
