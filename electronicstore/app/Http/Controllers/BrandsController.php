<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Type;
use App\Brand;
use App\Http\Requests;
use App\Http\Requests\BrandFormRequest;
use App\Http\Controllers\Controller;

class BrandsController extends Controller
{
    ///////////////////////////////////////////
    // Hàm hiển thị trang thêm hãng sản phẩm //
    ///////////////////////////////////////////
    public function add() 
    {
    	$page = 'partials.admin-addBrand';
        $users = User::all();

        return view('quantri/admin', compact('page', 'users', 'brands', 'types'));
    }

    ////////////////////////////////////////////////////////
    // Hàm lưu thông tin hãng sản phẩm mới được nhập vào. //
    ////////////////////////////////////////////////////////
    public function store(BrandFormRequest $request)
    {
    	$page = 'partials.admin-addBrand';
        $users = User::all();
        $brand_name = $request->input('brand_name'); // Nhận các giá trị từ trang thêm sản phẩm
        $brand_type = $request->input('brand_type'); // sử dụng lớp BrandFormRequest để kiểm tra các thông tin

        //Thêm mới sản phẩm vào bảng brands
        Brand::create([
        	'brand_name' => $brand_name,
        	'brand_type' => $brand_type
        ]);

        return redirect()->route('admin.brandManagement'); 
    }

    /////////////////////////////
    // Hiển thị trang sử  hãng //
    /////////////////////////////
    public function edit($id)
    {
    	$page = 'partials.admin-editBrand';
        $users = User::all();
        $brand = Brand::find($id);

        return view('quantri/admin', compact('page', 'users', 'brand'));
    }

    ///////////////////////////////////////////////////
    // Lưu các thông tin được chỉnh sửa vào database //
    ///////////////////////////////////////////////////
    public function update($id, BrandFormRequest $request)
    {
        $brand = Brand::find($id);
        $brand_name = $request->input('brand_name');
        $brand_type = $request->input('brand_type');
        
        $brand->update([
            'brand_name' => $brand_name,
            'brand_type' => $brand_type
        ]);

        return redirect()->route('admin.brandManagement');
    }
}
