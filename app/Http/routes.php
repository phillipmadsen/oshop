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

App::bind('Ecommerce\Billing\BillingInterface', 'Ecommerce\Billing\StripeBilling');


// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

/**
 * Admin Panel Routes
 */

Route::get('/admin', 'AdminController@index');
Route::get('/admin/products', 'AdminController@products');
Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/categories', 'AdminController@categories');
Route::get('/admin/sections', 'AdminController@sections');
Route::get('/admin/payment', 'AdminController@payment');
Route::post('/admin/payment', 'AdminController@paymentConfig');
Route::get('/admin/orders', 'AdminController@orders');
Route::get('/admin/messages', 'AdminController@messages');
Route::get('/admin/pages', 'AdminController@pages');
Route::get('/admin/coupons', 'AdminController@coupons');

Route::get('/admin/product/create', 'AdminController@createProduct');
Route::get('/admin/product/{id}/edit', 'AdminController@editProduct');
Route::get('/admin/category/create', 'AdminController@createCategory');
Route::get('/admin/category/{id}/edit', 'AdminController@editCategory');
Route::get('/admin/user/create', 'AdminController@createUser');
Route::get('/admin/user/{id}/edit', 'AdminController@editUser');
Route::get('/admin/section/create', 'AdminController@createSection');
Route::get('/admin/section/{id}/edit', 'AdminController@editSection');
Route::get('/admin/message/{id}', 'AdminController@showMessage');
Route::get('/admin/order/{id}', 'AdminController@showOrder');
Route::get('/admin/page/create', 'AdminController@createPage');
Route::get('/admin/page/{page_name}/edit', 'AdminController@editPage');
Route::get('/admin/coupon/create', 'AdminController@createCoupon');
Route::get('/admin/coupon/{id}/edit', 'AdminController@editCoupon');


/**
 * Pages Routes
 */
Route::post('/page/create', 'PageController@store');
Route::post('/page/{page_name}/edit', 'PageController@edit');
Route::get('/pages/{page_name}', 'PageController@show');
Route::get('/page/{page_name}/delete', 'PageController@delete');


/**
 * Orders Routes
 */
Route::post('/order/{id}/update', 'OrderController@update');
Route::get('/order/{id}/show', 'OrderController@show');


/**
 * Messages Routes
 */
Route::get('/contact', 'MessageController@show');
Route::post('/contact', 'MessageController@store');
Route::get('/message/{id}/delete', 'MessageController@delete');

/**
 * Section Routes
 */
Route::post('/section/create', 'SectionController@store');
Route::post('/section/{id}/edit', 'SectionController@edit');
Route::get('/section/{id}/delete', 'SectionController@delete');

/**
 * Users Routes
 */
Route::get('/dashboard', 'UserController@dashboard');
Route::post('/dashboard/editAccount', 'UserController@editAccount');
Route::post('/dashboard/editInfo', 'UserController@editInfo');

Route::get('/user/{id}/delete', 'UserController@delete');
Route::post('/user/create', 'UserController@store');
Route::post('/user/{id}/edit', 'UserController@edit');
Route::post('/user/edit', 'UserController@edit');



/**
 * Products Routes
 */
// Route::get('/', 'ProductController@index');
Route::get('/', array(
    'as' => 'home',
    'uses' => 'ProductController@index',
));
Route::post('/product/create', 'ProductController@store');
Route::get('/product/{id}/delete', 'ProductController@delete');
Route::post('/product/{id}/edit', 'ProductController@edit');
Route::get('/product/{id}-{slug}/show', 'ProductController@show');
Route::get('/product/{id}/photo/{photo_id}/delete', 'ProductController@deletePhoto');
Route::get('/option/{id}/delete', 'ProductController@deleteOption');
Route::get('/optionvalue/{id}/delete', 'ProductController@deleteOptionValue');
Route::get('/search', 'ProductController@search');


/**
 * Coupons Routes
 */
Route::post('/coupon/create', 'CouponController@store');
Route::get('/coupon/{id}/delete', 'CouponController@delete');
Route::post('/coupon/{id}/edit', 'CouponController@edit');
Route::post('/coupon/apply', 'CouponController@apply');
/**
 * Cart Routes
 */

Route::get('/cart', 'CartController@index');
Route::get('/cart/shipping', 'CartController@shipping');
Route::post('/cart/shipping', 'CartController@storeShippingInformation');
Route::post('/cart/payment', 'CartController@payment');
Route::get('/cart/clear', 'CartController@clear');
Route::post('/cart/edit/{product_id}', 'CartController@edit');
Route::get('/cart/remove/{product_id}', 'CartController@remove');
Route::get('/cart/add/{product_id}', 'CartController@add');

/**
 * Paypal Routes
 */

Route::get('/payment/paypal', 'PaypalController@postPayment');
Route::get('payment/status', array(
    'as' => 'payment.status',
    'uses' => 'PaypalController@getPaymentStatus',
));

/**
 * Categories Routes
 */

Route::get('/category/{id}/delete', 'CategoryController@delete');
Route::get('/category/{id}/show', 'CategoryController@show');
Route::post('/category/create', 'CategoryController@store');
Route::post('/category/{id}/edit', 'CategoryController@edit');


Route::get('/payment', function () {
    $publishable_key = App\Payment::first()->stripe_publishable_key;
    return view('payment', compact("publishable_key"));
});
