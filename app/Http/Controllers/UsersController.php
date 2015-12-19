<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Input;
use App\User;
use App\Order;
use App\Http\Requests;
use App\Http\Requests\UserFormRequest;
use App\Http\Requests\UserEditFormRequest;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function editUser($id)
    {
    	$user = User::find($id);
    	$page = 'partials.profile-edit';

    	return view('webcontent/profile', compact('user', 'page'));
    }

    public function is_active($id)
    {
        $page = 'partials.admin-userManagement';
        $users = User::all();
        $manage_users = User::simplePaginate(8);
        $manage_users->setPath('');
        // --------------- //
        $identifier = User::find($id);
        $user_order = Order::where('user_id', '=', $identifier->id)
                            ->first();
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

    public function updateUser($id, UserEditFormRequest $request)
    {
    	$user 			= User::find($id);
    	$page 			= 'partials.userInformation';
    	$name 			= $request->input('name');
    	$gender 		= $request->input('gender');
    	$dob 			= $request->input('dob');
    	$phone 			= $request->input('phone');

    	$user->update([
    		'name' => $name,
    		'gender' => $gender,
    		'dob' => $dob,
    		'phone' => $phone,
    		]);
    	return redirect()->route('show.profile', $id);
    }

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

    public function changePassword($id)
    {
        $page = 'partials.profile-changepassword';
        $user = User::find($id);

        return view('webcontent/profile', compact('page', 'user'));
    }

    public function updatePassword($id, UserFormRequest $request)
    {
        $user = User::find($id);
        
        $user->update([
            'password' => bcrypt($request->input('password'))
            ]);
        return redirect()->route('show.profile', $id);
    }
}
