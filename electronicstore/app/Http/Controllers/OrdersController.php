<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Order;
use App\OrderDetail;
use Carbon;
use App\Http\Requests;
use App\Http\Requests\OrderFormRequest;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function showOrders()
    {
    	$page = 'partials.admin-orderManagement';
        $users = User::all();
        $orders = Order::simplePaginate(8);
        //
        return view('quantri/admin', compact('page', 'users', 'orders'));
    }

    public function editOrder($id)
    {
    	$start_date = Carbon\Carbon::today()->format('Y-m-d');
    	$page = 'partials.admin-editOrder';
        $users = User::all();
        $order = Order::find($id);
        //
    	return view('quantri/admin', compact('page', 'users', 'order', 'start_date'));
    }

    public function changeOrder($id, OrderFormRequest $request)
    {
    	$order = Order::find($id);
    	$received_date = $request->input('received_date');
    	$address = $request->input('address');
    	$receiver_name = $request->input('receiver_name');
    	$phone = $request->input('phone');
    	//
    	$order->update([
    		'received_date' => $received_date,
    		'address' => $address,
    		'receiver_name' => $receiver_name,
    		'phone' => $phone
    		]);

    	return redirect()->route('admin.orderManagement');
    }

    public function updateStatus($id)
    {
    	$order = Order::find($id);
    	if($order->status == 0)
    	{
    		$order->status = 1;
    	}
    	else
    	{
    		$order->status = 0;
    	}
    	$order->save();

    	return redirect()->route('admin.orderManagement');
    }

    public function showOrderdetails()
    {
    	$page = 'partials.admin-orderdetailsManagement';
        $users = User::all();
        $orderdetails = OrderDetail::simplePaginate(8);
        //
        return view('quantri/admin', compact('page', 'users', 'orderdetails'));
    }
}
