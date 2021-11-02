<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;



class Role extends Model

{

    use HasFactory;



    protected $table = 'roles';



    protected $primaryKey = 'id';

    

    protected $fillable = ['title','status'];

    

    public $timestamps = true;
    protected $casts = [
        'status' => 'integer',
    ];


    public function Staffs(){

        return $this->hasMany('App\Models\Staff','role_id','id');

    }



}

