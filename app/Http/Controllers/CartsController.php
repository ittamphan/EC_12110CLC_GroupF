<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Order;
use App\OrderDetail;
use App\Product;
use Cart;
use Input;
use Auth;
use Carbon;
use App\Http\Requests;
use App\Http\Requests\OrderFormRequest;
use App\Http\Controllers\Controller;

class CartsController extends Controller
{

	public function cart()
    {
    	$items = Cart::content();
    	$total = Cart::total();

    	return view('cart/mycart', compact('items', 'total'));
    }

    public function addToCart($id)
    {
    	$product = Product::find($id);
        if($product->sale_price != 0)
        {
            $price = $product->sale_price;
        }
        else
        {
            $price = $product->price;
        }
    	Cart::add([
    		'id' => $id,
    		'name' => $product->product_name,
    		'qty' => 1,
    		'price' => $price,
    		'options' => array('image' => $product->image1)
    		]);
    	$items = Cart::content();
    	$total = Cart::total();
    	return view('cart/mycart', compact('items', 'total'));
    }

    public function updateItem()
    {
    	$new_quantity = Input::get('quantity');
    	$rowid = Input::get('rowid');
    	Cart::update($rowid, array(
    		'qty' => $new_quantity
    		));

    	return redirect()->route('mycart');
    }

    public function removeItem($id)
    {
    	Cart::remove($id);

    	return redirect()->route('mycart');
    }

    public function checkout()
    {
        $start_date = Carbon\Carbon::today()->format('Y-m-d');
        $user_address = Order::where('id', '=', Auth::user()->id)->select('address')->first();
        $items = Cart::content();
        $total = Cart::total();
        return view('cart/checkout', compact('items', 'total', 'start_date', 'user_address'));
    }

    public function order($id, OrderFormRequest $request)
    {
        $receiver_name = $request->input('receiver_name');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $received_date = $request->input('received_date');
        //
        $result = Order::create([
            'user_id' => $id,
            'receiver_name' => $receiver_name,
            'received_date' => $received_date,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            ]);
        if(count($result) > 0)
        {
            $items = Cart::content();
            $ordered_id = Order::select('id')
                               ->orderBy('id', 'desc')
                               ->first();
            foreach($items as $item)
            {
                OrderDetail::create([
                    'ordered_id' => $ordered_id->id,
                    'user_id' => $id,
                    'product_id' => $item->id,
                    'quantity' => $item->qty,
                    'price' => $item->price
                    ]);
            }
        }
        Cart::destroy();
        return redirect()->route('completed');
    }

    public function emptyCart()
    {
        Cart::destroy();
        $items = Cart::content();
        $total = Cart::total();
        
        return view('cart/mycart', compact('items', 'total'));
    }

    public function completed()
    {
        return view('cart/completed');
    }
}
