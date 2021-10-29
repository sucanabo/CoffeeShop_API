<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use App\Models\Product;

use App\Models\User;



class Favourite extends Model

{

    use HasFactory;



    protected $table = 'favourites';



    protected $primaryKey = 'id';

    



    protected $fillable = 

    [

        'user_id',

        'product_id'

    ];



    public $timestamps = true;



    public function product(){

        return $this->belongsto(Product::class,'product_id','id');

    }



    public function user(){

        return $this->belongsto(User::class,'user_id','id');

    }

}

