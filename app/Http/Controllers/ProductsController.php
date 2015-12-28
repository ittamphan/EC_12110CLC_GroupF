<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Type;
use App\Brand;
use App\Product;
use App\Feedback;
use App\Rate;
use App\Order;
use App\OrderDetail;
use App\Http\Requests;
use App\Http\Requests\ProductFormRequest;
use App\Http\Controllers\Controller;
use DB;
use Cart;
use Input;

class ProductsController extends Controller
{
    /////////////////////////////////////////////////
    // Hiển thị tất cả các sản phẩm trong hệ thống //
    /////////////////////////////////////////////////
    public function showproducts()
    {
        $number_of_items = Cart::content(); // Lấy các sản phẩm có trong cart
        $brands_mobile = Brand::where('brand_type', 'LIKE', '%phone%')->get(); // Lấy loại có tên là PHONE
        $brands_desktop = Brand::where('brand_type', 'LIKE', '%desktop%')->get(); // Tương tự trên
        $brands_laptop = Brand::where('brand_type', 'LIKE', '%laptop%')->get(); // Tương tự trên
        $brands_camera = Brand::where('brand_type', 'LIKE', '%camera%')->get(); // Tương tự trên
        $brands_tv = Brand::where('brand_type', 'LIKE', '%tv%')->get(); // Tương tự trên
 		$products = Product::paginate(12); // Phân trang, 12 sản phẩm một trang
 		$products->setPath('products');

 		return view('webcontent/products', compact('products', 'brands_mobile', 'brands_desktop',
         'brands_laptop', 'brands_camera', 'brands_tv', 'number_of_items', 'number_of_items'));
    }

    /////////////////////////////
    // Xem sản phẩm theo loại. //
    /////////////////////////////
    public function showProductsInType($id)
    {
        $number_of_items = Cart::content();
        $brands_mobile = Brand::where('brand_type', 'LIKE', '%phone%')->get();
        $brands_desktop = Brand::where('brand_type', 'LIKE', '%desktop%')->get();
        $brands_laptop = Brand::where('brand_type', 'LIKE', '%laptop%')->get();
        $brands_camera = Brand::where('brand_type', 'LIKE', '%camera%')->get();
        $brands_tv = Brand::where('brand_type', 'LIKE', '%tv%')->get();
    	$products = Product::where('type_id', '=', $id)->paginate(12);
    	$products->setPath('');

    	return view('webcontent/products', compact('products', 'brands_mobile', 'brands_desktop',
         'brands_laptop', 'brands_camera', 'brands_tv', 'number_of_items'));
    }

    ////////////////////////////
    // Xem sản phẩm theo hãng //
    ////////////////////////////
    public function showProductsInBrand($type_id, $id)
    {   
        $number_of_items = Cart::content();
        $brands_mobile = Brand::where('brand_type', 'LIKE', '%phone%')->get();
        $brands_desktop = Brand::where('brand_type', 'LIKE', '%desktop%')->get();
        $brands_laptop = Brand::where('brand_type', 'LIKE', '%laptop%')->get();
        $brands_camera = Brand::where('brand_type', 'LIKE', '%camera%')->get();
        $brands_tv = Brand::where('brand_type', 'LIKE', '%tv%')->get();
        //Search all products with the given brand and type
        $products = Product::where('brand_id', '=', $id)
                             ->where('type_id', '=', $type_id)
                             ->paginate(12);
        $products->setPath('');

        return view('webcontent/products', compact('products', 'brands_mobile', 'brands_desktop',
         'brands_laptop', 'brands_camera', 'brands_tv', 'number_of_items'));
    }

    ///////////////////////////
    // Xem chi tiết sản phẩm //
    ///////////////////////////
    public function detail($id)
    {
        $number_of_items = Cart::content();
    	$product = Product::find($id); // Tìm sản phẩm có ID như trên trong database để lấy dữ liệu
    	$type = Type::all(); // Lấy tất cả các loại sp
        $users = User::all(); // Lấy tất cả các người dùng
        $feedbacks = Feedback::where('product_id', '=', $id)->get(); // Hiển thị những Feedback có id Sản phẩm như trên
        $rate_stars = DB::table('rates')->where('product_id', '=', $id)->avg('rate'); // Tính trung bình đánh giá của sp đó
    	$related_product = Product::where('type_id', '=', $product->type_id)
                                    ->orderByRaw('RAND()')->take(4)->get(); // Hiển thị những sản phẩm liên quan, cùng loại
        if($product->sale_price != 0) // Lấy giá trị của Giá giảm giá nếu có
        {
            $price = $product->sale_price;
        }
        else
        {
            $price = $product->price;
        }

    	return view('webcontent/detail', compact('product', 'price','type', 'related_product', 'number_of_items', 'feedbacks', 'users', 'rate_stars'));
    }

    ///////////////////////////
    // Hàm tìm kiếm sản phẩm //
    ///////////////////////////
    public function search()
    {
        $number_of_items = Cart::content();
        $brands_mobile = Brand::where('brand_type', 'LIKE', '%phone%')->get();
        $brands_desktop = Brand::where('brand_type', 'LIKE', '%desktop%')->get();
        $brands_laptop = Brand::where('brand_type', 'LIKE', '%laptop%')->get();
        $brands_camera = Brand::where('brand_type', 'LIKE', '%camera%')->get();
        $brands_tv = Brand::where('brand_type', 'LIKE', '%tv%')->get();
        //Search
        $keyword = Input::get('keyword'); // Nhận keyword về
        $products = Product::where('product_name', 'LIKE', '%'.$keyword.'%')->paginate(); // Lấy những sản phẩm có tên như keyword
        $products->setPath('');

        return view('webcontent/search', compact('products', 'brands_mobile', 'brands_desktop',
         'brands_laptop', 'brands_camera', 'brands_tv', 'number_of_items', 'keyword'));

    }

    //////////////////////////////////////
    // Hàm hiển thị trang thêm sản phẩm //
    //////////////////////////////////////
    public function addProduct()
    {
        $page = 'partials.admin-addProduct';
        $users = User::all();
        $types = Type::all();
        $brands = Brand::all();

        return view('quantri/admin', compact('page', 'users', 'brands', 'types'));
    }

    ///////////////////////////////////////////////////////////////
    // Hàm lưu các thông tin của sản phẩm mới vào trong database //
    ///////////////////////////////////////////////////////////////
    public function storeProduct(ProductFormRequest $request)
    {
        // $product_name = Input::get('product_name'); //Hoặc có thể sử dụng cú pháp này
        $product_name       = $request->input('product_name');
        $type               = $request->input('type');
        $brand              = $request->input('brand');
        $price              = $request->input('price');
        $sale_price         = $request->input('sale_price');
        $quantity           = $request->input('quantity');
        $product_info       = $request->input('product_info');
        $short_description  = $request->input('short_description');
        $description        = $request->input('description');
        $image1             = $request->file('image1');
        $image2             = $request->file('image2');
        $image3             = $request->file('image3');
        $thumbnail1         = $request->file('thumbnail1');
        $thumbnail2         = $request->file('thumbnail2');
        $thumbnail3         = $request->file('thumbnail3');

        Product::create([
            'product_name'      => $product_name,
            'type_id'           => $type,
            'brand_id'          => $brand,
            'price'             => $price,
            'sale_price'        => $sale_price,
            'quantity'          => $quantity,
            'product_info'      => $product_info,
            'short_description' => $short_description,
            'description'       => $description,
            'image1'            => $image1->getClientOriginalName(),
            'image2'            => $image2->getClientOriginalName(),
            'image3'            => $image3->getClientOriginalName(),
            'thumbnail1'        => $thumbnail1->getClientOriginalName(),
            'thumbnail2'        => $thumbnail2->getClientOriginalName(),
            'thumbnail3'        => $thumbnail3->getClientOriginalName(),
            ]);
        $image1->move('public/images/product_images', $image1->getClientOriginalName());
        $image2->move('public/images/product_images', $image2->getClientOriginalName());
        $image3->move('public/images/product_images', $image3->getClientOriginalName());
        $thumbnail1->move('public/images/product_images', $thumbnail1->getClientOriginalName());
        $thumbnail2->move('public/images/product_images', $thumbnail2->getClientOriginalName());
        $thumbnail3->move('public/images/product_images', $thumbnail3->getClientOriginalName());

        return redirect()->route('admin.productManagement');
    }

    /////////////////////////////////////////////////
    // Hàm update các thông tin vào trong database //
    /////////////////////////////////////////////////
    public function updateProduct($id, ProductFormRequest $request)
    {
        $product = Product::find($id);
        $product_name       = $request->input('product_name');
        $type               = $request->input('type');
        $brand              = $request->input('brand');
        $price              = $request->input('price');
        $sale_price         = $request->input('sale_price');
        $quantity           = $request->input('quantity');
        $product_info       = $request->input('product_info');
        $short_description  = $request->input('short_description');
        $description        = $request->input('description');
        $image1             = $request->file('image1');
        $image2             = $request->file('image2');
        $image3             = $request->file('image3');
        $thumbnail1         = $request->file('thumbnail1');
        $thumbnail2         = $request->file('thumbnail2');
        $thumbnail3         = $request->file('thumbnail3');
        //Let's update database
        $product->update([
            'product_name'      => $product_name,
            'type_id'           => $type,
            'brand_id'          => $brand,
            'price'             => $price,
            'sale_price'        => $sale_price,
            'quantity'          => $quantity,
            'product_info'      => $product_info,
            'short_description' => $short_description,
            'description'       => $description,
            'image1'            => $image1->getClientOriginalName(),
            'image2'            => $image2->getClientOriginalName(),
            'image3'            => $image3->getClientOriginalName(),
            'thumbnail1'        => $thumbnail1->getClientOriginalName(),
            'thumbnail2'        => $thumbnail2->getClientOriginalName(),
            'thumbnail3'        => $thumbnail3->getClientOriginalName(),
            ]);
        $image1->move('public/images/product_images', $image1->getClientOriginalName());
        $image2->move('public/images/product_images', $image2->getClientOriginalName());
        $image3->move('public/images/product_images', $image3->getClientOriginalName());
        $thumbnail1->move('public/images/product_images', $thumbnail1->getClientOriginalName());
        $thumbnail2->move('public/images/product_images', $thumbnail2->getClientOriginalName());
        $thumbnail3->move('public/images/product_images', $thumbnail3->getClientOriginalName());
        
        return redirect()->route('admin.productManagement');
    }

    /////////////////////////////////////////////////////////////////////////
    // Hàm xóa sản phẩm (Dành cho test - Hệ thống không được xóa sản phẩm) //
    /////////////////////////////////////////////////////////////////////////
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('admin.productManagement');
    }

    ///////////////////////////////////////////////
    // Hàm chỉnh sản phẩm thành sản phẩm NỘI BẬT //
    ///////////////////////////////////////////////
    public function is_feature($id)
    {
        $product = Product::find($id);
        if($product->is_feature == 0)
        {
            $product->is_feature = 1;
        }
        else
        {
            $product->is_feature = 0;
        }
        $product->save();

        return redirect()->route('admin.productManagement');
    }

    ///////////////////////////////////////////////////////////////////////////////////
    // Hàm ngưng hoạt động sản phẩm (Chỉ khi sản phẩm trong hóa đơn đươc thanh toán) //
    ///////////////////////////////////////////////////////////////////////////////////
    public function is_disabled($id)
    {
        $product = Product::find($id);
        $orderdetail = OrderDetail::where('product_id', '=', $product->id)->first();
        if(count($orderdetail))
        {
            $order = Order::find($orderdetail->ordered_id);
            if($order->status == 0)
            {
                echo "<script>
                        alert('This product is in an Order that HAS NOT paid yet!');
                        window.history.back();
                    </script>";
            }
            else
            {
                if($product->is_disabled == 0)
                {
                    $product->is_disabled = 1;
                }
                else
                {
                    $product->is_disabled = 0;
                }
                $product->save();
                
                return redirect()->route('admin.productManagement');
                }
        }
        else
        {
            if($product->is_disabled == 0)
            {
                $product->is_disabled = 1;
            }
            else
            {
                $product->is_disabled = 0;
            }
            $product->save();
            
            return redirect()->route('admin.productManagement');
        }
    }


    ///////////////////////////////////////////////
    // Hàm đánh giá sản phẩm (giá trị từ 1 -> 5) //
    ///////////////////////////////////////////////
    public function rating($id, $user_id)
    {
        $rate = Input::get('rate');
        Rate::create([
            'user_id' => $user_id,
            'product_id' => $id,
            'rate' => $rate
            ]);
    }
}
