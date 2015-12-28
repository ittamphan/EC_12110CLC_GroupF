<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB; //Sử dụng class DB
use Input; // Sử dụng class Input
use App\Type; // Sử dụng class Type
use App\User; // Sử dụng class User
use App\Order; // Sử dụng class Order
use App\Brand; // Sử dụng class Brand
use App\Product; // Sử dụng class Product
use App\Feedback; // Sử dụng class Feedback
use App\Wishlist; // Sử dụng class Wishlist
use App\Http\Requests;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserEditFormRequest;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    // Hàm để vào trang chỉnh sửa thông tin người dùng
    public function editUser($id)
    {
    	$user = User::find($id);
    	$page = 'partials.profile-edit';

    	return view('webcontent/profile', compact('user', 'page'));
    }

    // Hàm thực thi việc cho User hoạt động hay ngưng hoạt động.
    public function is_active($id)
    {
        $page = 'partials.admin-userManagement';
        $users = User::all(); // Lấy hết tất cả các User có trong table users
        $manage_users = User::simplePaginate(8); // Phân trang
        $manage_users->setPath(''); // Chỉnh đường dẫn URL
        // --------------- //
        $identifier = User::find($id); // Tìm user có ID như $id cho vào biến $identifier
        $user_order = Order::where('user_id', '=', $identifier->id) // Lấy Hóa đơn của người dùng có ID như trên 
                            ->first();
        ///////////////////////////////////////////////////////////
        // Câu điều kiện kiểm tra nếu người dùng có hóa đơn chưa //
        // thanh toán thì không cho người dùng đó ngưng hoạt động//
        ///////////////////////////////////////////////////////////
        if(count($user_order) == 0 || $user_order->status == 1)
        {
            if($identifier->is_active == 1)
            {
                $identifier->is_active = 0;
            }
            else
            {
                $identifier->is_active = 1;
            }
            $identifier->save();

            return redirect()->route('admin.userManagement');
        }
        else
        {
            
            echo "<script>
                    alert('This user havent paid his/her Order yet!');
                    window.history.back();
                 </script>";
        }
    }

    ////////////////////////////////////////////////////
    // Hàm lưu những thông tin chỉnh sửa vào database //
    ////////////////////////////////////////////////////
    public function updateUser($id, UserEditFormRequest $request)
    {
    	$user 			= User::find($id);
    	$page 			= 'partials.userInformation';
    	$name 			= $request->input('name');
    	$gender 		= $request->input('gender');
    	$dob 			= $request->input('dob');
    	$phone 			= $request->input('phone');

        //////////////////////////////////
        // Update user có ID như dc gọi //
        //////////////////////////////////
    	$user->update([
    		'name' => $name,
    		'gender' => $gender,
    		'dob' => $dob,
    		'phone' => $phone,
    		]);
    	return redirect()->route('show.profile', $id);
    }

    ////////////////////////////////////////
    // Hàm thay đổi avatar cho người dùng //
    ////////////////////////////////////////
    public function changeAvatar($id)
    {
    	$user = User::find($id);
    	$profile_pic = Input::file('profile_pic');
    	$user->update([
    		'profile_pic' => $profile_pic->getClientOriginalName()
    		]);
    	$profile_pic->move('public/assets-admin/img', $profile_pic->getClientOriginalName());

    	return redirect()->route('show.profile', $id);
    }

    //////////////////////////////////////////
    // Hàm thay đổi password cho người dùng //
    //////////////////////////////////////////
    public function changePassword($id)
    {
        $page = 'partials.profile-changepassword';
        $user = User::find($id);

        return view('webcontent/profile', compact('page', 'user'));
    }

    //////////////////////////////////
    // Hàm lưu password vừa mới đổi //
    //////////////////////////////////
    public function updatePassword($id, UserFormRequest $request)
    {
        $user = User::find($id);
        
        $user->update([
            'password' => bcrypt($request->input('password'))
            ]);
        return redirect()->route('show.profile', $id);
    }

    ///////////////////////////////////////
    // Hàm xem lịch sử mua hàng của user //
    ///////////////////////////////////////
    public function orderhistory($id)
    {
        $page = 'partials.profile-orderhistory';
        $orders = Order::where('user_id', '=', $id)->get();

        return view('webcontent/profile', compact('page', 'orders'));
    }

    ///////////////////////////////////////////////
    // Hàm xem những comment đã dc viết bởi USER //
    ///////////////////////////////////////////////
    public function commentshistory($id)
    {
        $page = 'partials.profile-commentshistory';
        $comments = Feedback::where('user_id', '=', $id)->get();

        return view('webcontent/profile', compact('page', 'comments'));
    }

    ////////////////////////////////////////////////////////////////////////////////////
    // Hàm xem những sản phẩm đã được cho vào Wishlist (Danh sách sản phẩm yêu thích) //
    ////////////////////////////////////////////////////////////////////////////////////
    public function wishlist($id)
    {
        $page = 'partials.profile-wishlist';
        $items = Wishlist::where('user_id', '=', $id)->get();
        $products = Product::all();
        $brands = Brand::all();
        $types = Type::all();

        return view('webcontent/profile', compact('page', 'items', 'products', 'brands', 'types'));
    }
}
