<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;
use App\Wishlist;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class WishlistsController extends Controller
{
    public function storeWishedProduct($id, $user_id)
    {
    	$item = Wishlist::where('product_id', '=', $id)->where('user_id', '=', $user_id)->get();
    	if(count($item))
    	{
    		echo "<script>
					alert('This Product is in your Wishlist already!');
					window.history.back();
    				</script>";
    	}
    	else
    	{
            $item = Product::find($id);
    		Wishlist::create([
			'user_id' => $user_id,
			'product_id' => $id,
            'brand_id' => $item->brand_id,
            'type_id' => $item->type_id,
			]);

			return redirect()->route('detail', compact('id'));
    	}
    }

    public function deleteWishlistItem($id)
    {
        $item = Wishlist::find($id);
        $item->delete();

        return redirect()->back();
    }
}
