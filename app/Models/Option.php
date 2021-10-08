<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductTopping;
use App\Models\OptionGroup;

class Option extends Model
{
    use HasFactory;
    protected $table = 'options';

    protected $primaryKey = 'id';
    
    protected $fillable = ['title','description','price','status'];
    
    public $timestamps = true;

    public function productOptions(){
        return $this->hasMany(ProductTopping::class,'option_id','id');
    }
    public function optionGroup(){
        return $this->belongsTo(OptionGroup::class,'option_group_id','id');
    }
}
