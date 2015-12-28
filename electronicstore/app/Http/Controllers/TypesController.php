<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Type;
use App\Brand;
use App\Http\Requests;
use App\Http\Requests\TypeFormRequest;
use App\Http\Controllers\Controller;

class TypesController extends Controller
{
    ///////////////////////////////////////////
    // Hàm hiển thị trang thêm loại sản phẩm //
    ///////////////////////////////////////////
    public function add()
    {
    	$page = 'partials.admin-addType';
        $users = User::all();

        return view('quantri/admin', compact('page', 'users'));
    }

    ////////////////////////////////////////////////////
    // Hàm lưu các thông tin của loại mới và database //
    ////////////////////////////////////////////////////
    public function store(TypeFormRequest $request)
    {
    	$type_name = $request->input('type_name');
    	Type::create([
    		'type_name' => $type_name
    		]);

    	return redirect()->route('admin.typeManagement');
    }

    ///////////////////////////////////////////
    // Hàm hiển thị trang Edit loại sản phẩm //
    ///////////////////////////////////////////
    public function edit($id)
    {
    	$page = 'partials.admin-editType';
        $users = User::all();
        $type = Type::find($id);

        return view('quantri/admin', compact('page', 'users', 'type'));
    }
    
    ////////////////////////////////////////////
    // Hàm lưu các sửa đổi vào trong database //
    ////////////////////////////////////////////
    public function update($id, TypeFormRequest $request)
    {
    	$type = Type::find($id);
    	$type->update([
    		'type_name' => $request->input('type_name')
    		]);

    	return redirect()->route('admin.typeManagement');
    }
}
