<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/test', [
// 	'as' => 'testpage',
// 	'uses' => 'ProductsController@test'
// 	]);


// Go to homepage
Route::get('/', function(){
	if(Auth::guest() || Auth::user()->is_admin == 0 )
	{
		return redirect()->route('homepage');
	}
	else
	{
		return redirect()->route('admin.dashboard');
	}
});

Route::get('/homepage', [
	'as' => 'homepage',
	'uses' => 'PagesController@index'
	]);
//
//
// Display all products
Route::get('/products', [
	'as' => 'show.products',
	'uses' => 'ProductsController@showproducts'
	]);
//
//
// Display products in TYPE
Route::get('/products/type/{id}', [
	'as' => 'show.typeproducts',
	'uses' => 'ProductsController@showProductsInType'
	]);
//
//
// Display products in BRAND
Route::get('/types/{type_id}/brands/{id}', [
	'as' => 'show.brandproducts',
	'uses' => 'ProductsController@showProductsInBrand'
	]);
//
//
// Display DETAIL of one product
Route::get('/product/detail/{id}', [
	'as' => 'detail',
	'uses' => 'ProductsController@detail'
	]);

//
//
// Display ABOUT page
Route::get('/about', [
	'as' => 'about',
	'uses' => 'PagesController@about'
	]);
//
//
// Display CONTACT page
Route::get('/contact', [
	'as' => 'contact',
	'uses' => 'PagesController@contact'
	]);
//
//
// Display DELIVERY page
Route::get('/delivery', [
	'as' => 'delivery',
	'uses' => 'PagesController@delivery'
	]);
//
//
// Display LOGIN page
Route::get('/login', [
	'as' => 'login',
	'uses' => 'Auth\AuthController@getLogin'
	]);
//
//
// POST LOGIN
Route::post('/login', 'Auth\AuthController@postLogin'); //POST Login
//
//
// Display REGISTER page
Route::get('/register', [
	'as' => 'register',
	'uses' => 'Auth\AuthController@getRegister'
	]);
//
//
// POST REGISTER
Route::post('/register', 'Auth\AuthController@postRegister');
//
//
//Display GET RESET PASSWORD LINK page
Route::get('/forgotpassword', [
	'as' => 'forgotpassword',
	'uses' => 'Auth\PasswordController@getEmail'
	]);
//
//
Route::post('/forgotpassword', [
	'as' => 'sendResetLink',
	'uses' => 'Auth\PasswordController@postEmail'
	]);
//
//
//Display RESET PASSWORD LINK page
Route::get('/password/reset/{token}', [
	'as' => 'getResetPassword',
	'uses' => 'Auth\PasswordController@getReset'
	]);
//
//
//Reset password
Route::post('/password/reset', [
	'as' => 'postResetPassword',
	'uses' => 'Auth\PasswordController@postReset'
	]);
//
//
// LOGOUT the system
Route::get('/logout', [
	'as' => 'logout',
	'uses' => 'Auth\AuthController@getLogout'
	]);
//
//
// Display all searched products
Route::get('/search', [
	'as' => 'show.searchProducts',
	'uses' => 'ProductsController@search'
	]);

// Using MIDDLEWARE with these ROUTE
Route::group(['middleware' => 'auth'], function() {
	//
	//
	// Display MYCART page
	Route::get('/mycart', [
	'as' => 'mycart',
	'uses' => 'CartsController@cart'
	]);
	//
	//
	//Add to cart
	Route::get('/cart/{id}/add', [
		'as' => 'addToCart',
		'uses' => 'CartsController@addToCart'
		]);
	//
	//
	//Update item in cart
	Route::post('/cart/update', [
		'as' => 'updateItem',
		'uses' => 'CartsController@updateItem'
		]);
	//
	//
	//Remove item in cart
	Route::get('/mycart/remove/{id}', [
		'as' => 'removeItem',
		'uses' => 'CartsController@removeItem'
		]);

	Route::get('/mycart/get-empty', [
		'as' => 'emptycart',
		'uses' => 'CartsController@emptyCart'
		]);
	//
	//
	//Display ordered page
	Route::get('/mycart/order', [
		'as' => 'checkout',
		'uses' => 'CartsController@checkout'
		]);

	Route::post('/mycart/order/{id}', [
		'as' => 'order',
		'uses' => 'CartsController@order'
		]);
	//Display Order completed screen
	Route::get('/completed', [
		'as' => 'completed',
		'uses' => 'CartsController@completed'
		]);
	//
	//
	//Display admin dashbpoard page
	Route::get('/admin/dashboard', [
	'as' => 'admin.dashboard',
	'uses' => 'PagesController@adminDashboard'
	]);
	//
	//
	// Display User management page
	Route::get('/admin/UserManagement', [
		'as' => 'admin.userManagement',
		'uses' => 'PagesController@userManagement'
		]);

	Route::get('/admin/userManagement/{id}', [
		'as' => 'admin.is_active',
		'uses' => 'UsersController@is_active'
		]);
	//
	//
	//Display Product management page
	Route::get('/admin/ProductManagement', [
		'as' => 'admin.productManagement',
		'uses' => 'PagesController@productManagement'
		]);
	//
	//
	//Display Brand management page
	Route::get('/admin/BrandManagement', [
		'as' => 'admin.brandManagement',
		'uses' => 'PagesController@brandManagement'
		]);
	//
	//
	//Display Type management page
	Route::get('/admin/TypeManagement', [
		'as' => 'admin.typeManagement',
		'uses' => 'PagesController@typeManagement'
		]);
	//
	//
	//Display add product page
	Route::get('/admin/product/add', [
		'as' => 'admin.addProduct',
		'uses' => 'ProductsController@addProduct'
		]);
	//Store product into database
	Route::post('/admin/product/add', [
		'as' => 'admin.storeProduct',
		'uses' => 'ProductsController@storeProduct'
		]);
	//
	//
	//Get product id and DELETE it from database.
	Route::delete('/admin/product/{id}/delete', [
		'as' => 'admin.productDelete',
		'uses' => 'ProductsController@deleteProduct'
		]);
	//
	//
	//Get product id and display insert page to edit it.
	Route::get('admin/product/{id}/edit', [
		'as' => 'admin.productEdit', 
		'uses' => 'PagesController@productEdit'
		]);
	//
	//
	//Update product information
	Route::put('admin/product/{id}', [
		'as' => 'admin.updateProduct', 
		'uses' => 'ProductsController@updateProduct'
		]);

	Route::get('/admin/product/is-feature/{id}', [
		'as' => 'admin.is_feature',
		'uses' => 'ProductsController@is_feature'
		]);

	Route::get('/admin/product/is-disabled/{id}', [
		'as' => 'admin.is_disabled',
		'uses' => 'ProductsController@is_disabled'
		]);

	Route::get('/admin/order-details', [
		'as' => 'admin.orderdetailShow',
		'uses' => 'OrdersController@showOrderdetails'
		]);
	//
	//
	//Display add BRAND page
	Route::get('/admin/brand/add', [
		'as' => 'admin.addBrand',
		'uses' => 'BrandsController@add'
		]);
	//
	//
	//Insert new BRAND into database
	Route::post('/admin/brand/add', [
		'as' => 'admin.storeBrand',
		'uses' => 'BrandsController@store'
		]);
	//
	//
	//Get BRAND id and display edit BRAND page
	Route::get('/admin/brand/{id}/edit', [
		'as' => 'admin.editBrand',
		'uses' => 'BrandsController@edit'
		]);
	//
	//
	//Update BRAND information 
	Route::put('/admin/brand/{id}', [
		'as' => 'admin.updateBrand',
		'uses' => 'BrandsController@update'
		]);
	//
	//
	//Get TYPE id and display edit TYPE page
	Route::get('/admin/type/add', [
		'as' => 'admin.addType',
		'uses' => 'TypesController@add'
		]);
	//
	//
	//Insert new TYPE to database
	Route::post('/admin/type/add', [
		'as' => 'admin.storeType',
		'uses' => 'TypesController@store'
		]);
	//
	//
	//Get TYPE id and display edit TYPE page
	Route::get('/admin/type/{id}/edit', [
		'as' => 'admin.editType',
		'uses' => 'TypesController@edit'
		]);

	//
	//Update TYPE information
	//
	Route::put('/admin/type/{id}/edit', [
		'as' => 'admin.updateType',
		'uses' => 'TypesController@update'
		]);

	//
	//Orders edit
	//
	Route::get('/admin/order/edit', [
		'as' => 'admin.orderManagement',
		'uses' => 'OrdersController@showOrders'
		]);

	//Edit Order information such as Date, Address,etc.
	Route::get('/admin/order/{id}/edit', [
		'as' => 'admin.editOrder',
		'uses' => 'OrdersController@editOrder'
		]);

	// Change Order information
	Route::put('/admin/order/{id}/edit', [
		'as' => 'admin.changeOrder',
		'uses' => 'OrdersController@changeOrder'
		]);

	// Update order status
	Route::get('/admin/order/{id}/status', [
		'as' => 'admin.updateStatus',
		'uses' => 'OrdersController@updateStatus'
		]);

	Route::get('/admin/top-users', [
		'as' => 'admin.topusers',
		'uses' => 'PagesController@topUsers'
		]);

	Route::get('/admin/top-brands-and-types', [
		'as' => 'admin.topbrandsandtypes',
		'uses' => 'PagesController@topBrandsAndTypes'
		]);

	Route::get('/admin/top-products', [
		'as' => 'admin.topproducts',
		'uses' => 'PagesController@topProducts'
		]);

	//
	//Profile edit
	//
	Route::get('/profile/{id}', [
		'as' => 'show.profile',
		'uses' => 'PagesController@profile'
		]);

	Route::get('/profile/edit/{id}', [
		'as' => 'edit.profile',
		'uses' => 'UsersController@editUser'
		]);

	Route::put('profile/edit/{id}', [
		'as' => 'update.profile',
		'uses' => 'UsersController@updateUser'
		]);

	Route::put('/profile/{id}', [
		'as' => 'changeAvatar',
		'uses' => 'UsersController@changeAvatar'
		]);

	Route::get('/profile/change-password/{id}', [
		'as' => 'changepassword',
		'uses' => 'UsersController@changePassword'
		]);

	Route::put('/profile/change-password/{id}', [
		'as' => 'updatePassword',
		'uses' => 'UsersController@updatePassword'
		]);

	Route::get('/profile/order-history/{id}', [
		'as' => 'orderhistory',
		'uses' => 'UsersController@orderhistory'
		]);

	Route::get('/profile/comments-history/{id}', [
		'as' => 'commentshistory',
		'uses' => 'UsersController@commentshistory'
		]);

	Route::get('/profile/wishlist/{id}', [
		'as' => 'wishlist',
		'uses' => 'UsersController@wishlist'
		]);

	Route::get('/add-to-wish-list/{id}/{user_id}', [
		'as' => 'storeWishedProduct',
		'uses' => 'WishlistsController@storeWishedProduct'
		]);

	Route::delete('/profile/delete-wishlist-item/{id}', [
		'as' => 'deleteWishlistItem',
		'uses' => 'WishlistsController@deleteWishlistItem'
		]);
});

Route::post('/send-review', [
	'as' => 'addfeedback',
	'uses' => 'FeedbacksController@storeFeedback'
	]);

Route::post('/rate/{id}/{user_id}', 'ProductsController@rating');