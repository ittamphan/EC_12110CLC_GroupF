<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Cart;
use Carbon\Carbon;
use App\Order;
use App\User;  
use App\Type;
use App\Brand;
use App\Product;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    public function index()
    {
        $number_of_items = Cart::content();
        $types = Type::all(); //Select * from Type
        $brands_mobile = Brand::where('brand_type', 'LIKE', '%phone%')->get();
        $brands_desktop = Brand::where('brand_type', 'LIKE', '%desktop%')->get();
        $brands_laptop = Brand::where('brand_type', 'LIKE', '%laptop%')->get();
        $brands_camera = Brand::where('brand_type', 'LIKE', '%camera%')->get();
        $brands_tv = Brand::where('brand_type', 'LIKE', '%tv%')->get();
        //Sản phẩm mới
        $new_product = Product::orderBy('created_at', 'desc')->take(4)->get();
        //Sản phẩm nổi bật
        $feature_products = Product::where('is_feature', '=', 1)->orderBy('updated_at', 'desc')->take(4)->get();
        //Big sales
        $sale_products = Product::orderBy('sale_price', 'desc')->take(4)->get();

    	return view('index', compact('types', 'new_product', 'feature_products', 'sale_products', 'brands_mobile', 'brands_desktop',
         'brands_laptop', 'brands_camera', 'brands_tv', 'number_of_items'));
    }

    public function profile($id)
    {
        $page = 'partials.profile-index';
        return view('webcontent/profile', compact('page'));
    }

    public function about()
    {
        $number_of_items = Cart::content();

    	return view('webcontent/about', compact('number_of_items'));
    }

    public function contact()
    {
        $number_of_items = Cart::content();

    	return view('webcontent/contact', compact('number_of_items'));
    }

    public function delivery()
    {
        $number_of_items = Cart::content();
        
    	return view('webcontent/delivery', compact('number_of_items'));
    }

    public function mycart()
    {
        return view('cart/mycart');
    }

    public function adminDashboard()
    {
        if(Auth::user()->is_admin == 0)
        {
            return redirect()->route('homepage');
        }
        else
        {
            $page = 'partials.admin-dashboard';
            $users = User::all();
            $user_count = User::count();
            $product_count = Product::count();
            $brand_count = Brand::count();
            $type_count = Type::count();
            $order_count = Order::count();
            $low_quantity = DB::table('products')->where('quantity', '<=', 5)->get();

            return view('quantri/admin', compact('page', 'users', 'user_count', 'product_count', 'brand_count'
                , 'type_count','order_count', 'top_products', 'top_users', 'low_quantity', 'top_types_this_month', 'top_brands_this_month'));
        }
    }

    public function topUsers()
    {
        $page = 'partials.admin-topUsers';
        $users = User::all();
        $top_users = DB::table('users')->join('orderdetails', 'users.id', '=', 'orderdetails.user_id')
                        ->select('orderdetails.user_id', 'name', 'profile_pic', 'users.created_at', 'orderdetails.price', DB::raw('sum(orderdetails.price) as total_price'))
                        ->groupBy('name')
                        ->orderBy('total_price', 'desc')->take(3)->get();

        return view('quantri/admin', compact('page', 'users', 'top_users'));
    }

    public function topBrandsAndTypes()
    {
        $page = 'partials.admin-topBrandsAndTypes';
        $users = User::all();
        $top_types_this_month = DB::table('products')->join('orderdetails', 'products.id', '=', 'orderdetails.product_id')
                            ->select('orderdetails.product_id', 'product_name', 'brands.brand_name', 'types.type_name', 'orderdetails.price', DB::raw('sum(orderdetails.quantity) as total_quantity'))
                            ->join('brands', 'brands.id', '=', 'products.brand_id')
                            ->join('types', 'types.id', '=', 'products.type_id')
                            ->where('orderdetails.created_at', '>=', Carbon::now()->startOfMonth())
                            ->groupBy('type_name')->get();

        $top_brands_this_month = DB::table('products')->join('orderdetails', 'products.id', '=', 'orderdetails.product_id')
                            ->select('orderdetails.product_id', 'product_name', 'brands.brand_name', 'types.type_name', 'orderdetails.price', DB::raw('sum(orderdetails.quantity) as total_quantity'))
                            ->join('brands', 'brands.id', '=', 'products.brand_id')
                            ->join('types', 'types.id', '=', 'products.type_id')
                            ->where('orderdetails.created_at', '>=', Carbon::now()->startOfMonth())
                            ->groupBy('brand_name')->get();

        return view('quantri/admin', compact('page', 'users', 'top_types_this_month', 'top_brands_this_month'));
    }

    public function topProducts()
    {
        $page = 'partials.admin-topProducts';
        $users = User::all();
        $top_products = DB::table('products')->join('orderdetails', 'products.id', '=', 'orderdetails.product_id')
                            ->select('orderdetails.product_id', 'product_name', 'orderdetails.price', DB::raw('sum(orderdetails.quantity) as total_quantity'))
                            ->groupBy('product_name')
                            ->orderBy('total_quantity', 'desc')->take(7)->get();

     return view('quantri/admin', compact('page', 'users', 'top_products'));   
    }

    public function userManagement() 
    {
        $page = 'partials.admin-userManagement';
        $users = User::all();
        $manage_users = User::simplePaginate(8);
        $manage_users->setPath('');

        return view('quantri/admin', compact('page', 'users', 'manage_users'));
    }

    public function productManagement() 
    {
        $page = 'partials.admin-productManagement';
        $users = User::all();
        $products = Product::orderBy('created_at', 'desc')->paginate(8);
        $products->setPath('');

        return view('quantri/admin', compact('page', 'users', 'products'));
    }

    public function brandManagement() 
    {
        $page = 'partials.admin-brandManagement';
        $users = User::all();
        $brands = Brand::paginate(8);
        $brands->setPath('');

        return view('quantri/admin', compact('page', 'users', 'brands'));
    }

    public function typeManagement() 
    {
        $page = 'partials.admin-typeManagement';
        $users = User::all();
        $types = Type::simplePaginate(8);
        $types->setPath('');

        return view('quantri/admin', compact('page', 'users', 'types'));
    }

    public function productEdit($id)
    {
        $page = 'partials.admin-editProduct';
        $users = User::all();
        $types = Type::all('type_name', 'id');
        $brands = Brand::all('brand_name', 'id');
        $product = Product::find($id);

        return view('quantri/admin', compact('page', 'users', 'product', 'types', 'brands'));
    }
}
