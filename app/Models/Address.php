<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;



class Address extends Model

{

    use HasFactory;

    

    protected $table = 'address';



    protected $primaryKey = 'id';

    

    protected $fillable = [

        'user_id',

        'title',

        'address',

        'coordinates',

        'description',

        'receiver_name',

        'receiver_phone',

    ];

    public $timestamps = true;

    public function user(){

        return $this->belongsTo(User::class,'user_id','id');

    }



}

