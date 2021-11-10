<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use App\Models\ProductTopping;

use App\Models\ProductVoucher;

use App\Models\OrderItem;

use App\Models\Category;

use App\Models\Rating;

use App\Models\Favourite;

use App\Models\Option;

use App\Models\OptionGroup;

use App\Models\Discount;
use Carbon\Carbon;


class Product extends Model

{

    use HasFactory;



    protected $table = 'products';



    protected $primaryKey = 'id';

    

    protected $fillable = 

    [

        'category_id',

        'title',

        'type',

        'price',

        'image',

        'content',

        'status'

    ];

    protected $appends = [

        'avgRating',

        'selfRating',

        'options',

        'discount',

    ];



    public $timestamps = true;





    public function productToppings(){

        return $this->hasMany(ProductTopping::class,'product_id','id');

    }

    public function getOptionsAttribute(){

        $options = DB::table('option_groups as og')

                    ->join('options as o','og.id','=','o.option_group_id')

                    ->select('og.title as og_title','o.id as o_id','o.option_group_id','o.title as o_title','o.option_group_id as o_group_id')

                    ->get();

        $products = $this->productOptions;

        $result = array();



        foreach($products as $product){

            

            foreach($options as $option){

                if($product->option_id == $option->o_id){

                    $key = $option->og_title;

                    $product = (object)$product;

                    $product['option_title'] = $option->o_title;

                    $product['option_group_id'] = $option->o_group_id;

                    if(!array_key_exists($key,$result)){

                        $newArr = array($product);

                        $result[$key] = $newArr;

                    }

                    else{

                        array_push($result[$key],$product);

                    }  

                }

            }

        }

        return $result;

        

    }
    protected $casts = [
        'id' => 'integer',
        'category_id' => 'integer',
        'status' => 'integer',
    ];

    public function productOptions(){

        return $this->hasMany(ProductOption::class,'product_id','id');

    }

    public function productVouchers(){

        return $this->hasMany(ProductVoucher::class,'product_id','id');

    }



    public function orderItems(){

        return $this->hasMany(OrderItem::class,'product_id','id');

    }



    public function category(){

        return $this->belongsTo(Category::class,'category_id','id');

    }



    public function ratings(){

        return $this->hasMany(Rating::class,'product_id','id');

    }

    public function favourites(){

        return $this->hasMany(Favourite::class,'product_id','id');

    }

    public function getAvgRatingAttribute(){

        return $this->ratings()->avg('star');

    }

    public function getSelfRatingAttribute(){

        return $this->ratings()->where('user_id',auth()->user()->id)->get()->first();

    }

    public function getDiscountAttribute(){

        $productId = $this->id;

        return DB::table('discounts')->whereRaw('FIND_IN_SET(?,products)',[$productId])->whereDate('expiry_date', '>=',Carbon::today())->get();
    }

}

