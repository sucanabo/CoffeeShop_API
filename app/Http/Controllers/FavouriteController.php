<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favourite;

class FavouriteController extends Controller
{
    public function checkFavourite($id){
        $product = Product::find($id);

        if(!$product){
            return response(['message' => 'Product not found.'],403);
        }

        $favourite = $product->favourites()->where('user_id', auth()->user()->id)->first();

        //if not favourited then favourite
        if(!$favourite){
            Favourite::create([
                'product_id' => $id,
                'user_id' => auth()->user()->id
            ]);
            
            return response(['message' => 'Favourited.'],200);
        }
        //else unfavourite
        $favourite->delete();
        
        return response(['message' => 'Unfavourite'],200);
        
    }
}
