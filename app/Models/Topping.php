<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use App\Models\ProductTopping;

class Topping extends Model

{

    use HasFactory;



    protected $table = 'toppings';



    protected $primaryKey = 'id';

    

    protected $fillable = ['title','price','status'];

    

    public $timestamps = true;

    protected $casts = [
        'status' => 'integer',
    ];

    public function productToppings(){

        return $this->hasMany(ProductTopping::class,'topping_id','id');

    }

}

