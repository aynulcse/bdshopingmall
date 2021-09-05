<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// frontend route
Route::get('/','Frontend\PagesController@index')->name('index');


Route::get('/products','Frontend\PagesController@products')->name('products');
// user token 
Route::get('/token/{token}','Frontend\VerificationsController@verified')->name('user.verification');
Route::get('/contacts','Frontend\PagesController@contacts')->name('contact');
Route::post('/contacts/store','Frontend\PagesController@store')->name('contact.store');

Route::get('/product/{id}','Frontend\PagesController@product_show')->name('product.show');
Route::get('/product/category/{id}','Frontend\PagesController@Category')->name('product.category');
Route::get('/search','Frontend\PagesController@search')->name('search');



// // admin login
 	Route::get('/admin/login','Auth\admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/admin/login','Auth\admin\LoginController@login')->name('admin.login.submit');



Route::group(['prefix'=>'admin'],function(){
	Route::get('/','Backend\PagesController@index')->name('admin.dashboard');
	
	//product route
	 Route::get('/product','Backend\ProductsController@index')->name('admin.product.index');
	 Route::post('/product/store','Backend\ProductsController@store');
	 Route::get('/product/edit/{id}','Backend\ProductsController@edit');
	 Route::post('/product/update','Backend\ProductsController@update');
	 Route::get('/product/delete/{id}','Backend\ProductsController@destroy');
	 Route::get('/product/block/{id}','Backend\ProductsController@Block');
	 Route::get('/product/subcategory/{id}','Backend\ProductsController@SubCategory');




	//category route
	 Route::get('category/','Backend\CategoryController@index')->name('admin.category.index');
	 Route::post('/category/store','Backend\CategoryController@store');
	 Route::get('/category/edit/{id}','Backend\CategoryController@edit');
	 Route::post('/category/update','Backend\CategoryController@update');
	 Route::get('/category/delete/{id}','Backend\CategoryController@destroy');

	 //Subcategory route
	 Route::get('/subcategory/','Backend\SubCategoryController@index')->name('admin.subcategory.index');
	 Route::post('/subcategory/store','Backend\SubCategoryController@store');
	 Route::get('/subcategory/edit/{id}','Backend\SubCategoryController@edit');
	 Route::post('/subcategory/update','Backend\SubCategoryController@update');
	 Route::get('/subcategory/delete/{id}','Backend\SubCategoryController@destroy');
	




	//divisions route
	 Route::get('district/','Backend\DistrictController@index')->name('admin.district.index');
	 Route::get('district/create','Backend\DistrictController@create');
	 Route::post('district/store','Backend\DistrictController@store');
	 Route::get('district/edit/{id}','Backend\DistrictController@edit');
	 Route::post('district/update','Backend\DistrictController@update');
	 Route::get('district/delete/{id}','Backend\DistrictController@destroy');
	
	//Thanas route
	 Route::get('thana/','Backend\ThanaController@index')->name('admin.thana.index');
	 Route::get('thana/create','Backend\ThanaController@create');
	 Route::post('thana/store','Backend\ThanaController@store');
	 Route::get('thana/edit/{id}','Backend\ThanaController@edit');
	 Route::post('thana/update','Backend\ThanaController@update');
	 Route::get('thana/delete/{id}','Backend\ThanaController@destroy');
	


	//Slider route
	 Route::get('slider/','Backend\SliderController@index')->name('admin.slider.index');
	  Route::post('slider/store','Backend\SliderController@store');
	 Route::get('slider/edit/{id}','Backend\SliderController@edit');
	 Route::post('slider/update','Backend\SliderController@update');
	 Route::get('slider/delete/{id}','Backend\SliderController@destroy');



	//Orders route
	 Route::get('order/','Backend\OrdersController@index')->name('admin.order.index');
	 Route::get('order/delete/{id}','Backend\OrdersController@destroy');
	 Route::get('order/seen/{id}','Backend\OrdersController@Seen');
	 Route::get('order/paid/{id}','Backend\OrdersController@Paid');
	 Route::get('order/complete/{id}','Backend\OrdersController@Complete');
	 Route::get('order/cancel/{id}','Backend\OrdersController@Cancel');
	 Route::get('order/view/{id}','Backend\OrdersController@View')->name('view.order');


	 Route::get('/contact','Backend\PagesController@Contact')->name('admin.contact');
	 Route::get('contact/delete/{id}','Backend\PagesController@destroy');
	
	
});





	//cart route
	Route::group(['prefix'=>'cart'],function(){
	 Route::get('/','frontend\CartsController@index')->name('carts');
	 Route::post('/store','frontend\CartsController@store')->name('cart.store');
	 Route::post('/update/{id}','frontend\CartsController@update')->name('cart.update');
	 Route::get('/delete/{id}','frontend\CartsController@destroy');
	});
	 Route::get('cart/plus/{id}','frontend\CartsController@Plus');
	 Route::get('cart/minus/{id}','frontend\CartsController@Minus');


	//checkout route
	Route::group(['prefix'=>'/checkouts'],function(){
	 Route::get('/','frontend\CheckoutsController@index')->name('checkouts');
	 Route::post('/store','frontend\CheckoutsController@store')->name('checkout.store');
	});

	Route::group(['prefix'=>'users'],function(){
	 Route::get('/','frontend\UsersController@index')->name('user.dashboard');
	 Route::get('/profile','frontend\UsersController@profile')->name('user.profile');
	 Route::get('/history','frontend\UsersController@history')->name('user.order.history');
	 Route::post('/update/{id}','frontend\UsersController@update')->name('user.update');
	});

	
	Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/register/thana/{id}','Auth\RegisterController@Thana');
Route::get('/update/thana/{id}','frontend\UsersController@Thana');

