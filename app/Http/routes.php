<?php


Route::get('/r', function ()
{

    function philsroutes()
	{
		$i=0;
		$routeCollection = Route::getRoutes();
		echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">';
		echo '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-toggle/2.2.2/css/bootstrap-toggle.css">';
		echo '<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="   crossorigin="anonymous"></script>';
		echo "<div style='margin-top:50px'></div><div class='container'><div class='col-md-12 table-responsive'>";
		echo "<table id='table' data-toggle='table' class='table table-condensed' style='width:100%'>";
		echo '<thead>';
			echo '<tr>';
				echo "<th width='5%'> </th>";
				echo "<th width='10%'><h4>Method</h4></th>";
				echo "<th width='25%'><h4>URL</h4></th>";
				echo "<th width='25%'><h4>Route Name</h4></th>";
				echo "<th width='30%'><h4>Corresponding Action</h4></th>";
			echo '</tr>';
		echo '<thead>';

		foreach ($routeCollection as $value)
		{
			$number = $i++;
			$secretrow = "secretrow";
			echo '<tr data-toggle="collapse" data-target="#'.$secretrow.$number.'" class="accordion-toggle">';
				echo '<td><button type="button" class="btn btn-info btn-md"><i class="glyphicon glyphicon-plus"></i></button></td>';
				echo '<td>' . $value->getMethods()[0] . '</td>';
				echo "<td  style='font-family:Inconsolata;font-size: 1.25em;''><a href='" . $value->getPath() . "' target='_blank'>" . $value->getPath() . '</a> </td>';
				echo '<td>' . $value->getName() . '</td>';
				echo '<td>' . $value->getActionName() . '</td>';
			echo '</tr>';
			echo '<tr>';
				echo '<td colspan="12" class=""> <div class="accordian-body collapse table-responsive" id="'.$secretrow.$number.'"><div style="clear:both"></div>';
					echo '<table class="table table-bordered"><thead><tr><td><a href="' . $value->getPath() . '"><strong>Visit This Link</strong></a></td></tr><tr><th>Copy Url</th></tr></thead>';
						echo '<tbody>';
						echo '<tr><td align="left"><pre style="font-family: Inconsolata;font-size: 1.25em;">{!! url(\'' . $value->getPath() . '\') !!}</pre></td></tr>';
						echo '<tr><td><strong>Copy Form Url</strong></td></tr>';
						echo '<tr><td align="left"><pre style="font-family:Inconsolata;font-size: 1.25em;">{!! Form::open([\'url\' => \'' . $value->getPath() . '\', \'method\' => \'post\', \'files\' => true]) !!}</pre></td></tr>';
						echo '<tr><td align="left"><strong>Copy Url Route</strong> </td></tr>';
						echo '<tr><td align="left"><pre style="font-family: Inconsolata;font-size: 1.25em;">{!! route(\'' . $value->getName() . '\') !!}</pre></td></tr>';
						echo '<tr><td align="left"><strong>Copy Form:: Route</strong> </td></tr>';
						echo '<tr><td align="left"><pre style="font-family:Inconsolata;font-size: 1.25em;">{!! Form::open([\'route\' => \''. $value->getName() .'\', \'method\' => \'post\', \'files\' => true]) !!}</pre></td></tr>';
						echo '<tr><td align="left"><strong>Copy Url Action</strong> </td></tr>';
						echo '<tr><td align="left"><pre style="font-family:Inconsolata;font-size: 1.25em;">{!! action(\'' . $value->getActionName() . '\']) !!}</pre></td></tr></tr>';
						echo '<tr><td align="left"><strong>Copy Form:: Action</strong> </td></tr>';
						echo '<tr><td align="left"><pre style="font-family:Inconsolata;font-size: 1.25em;"> {!! Form::open([\'action\' => \'' . $value->getActionName() . '\', \'method\' => \'post\', \'files\' => true]) !!}</pre></td></tr>';
					echo '</tbody></table></div>';
				echo '</td>';
			echo '</tr>';
		}
		echo '</table></div></div>';
		echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>';

	}
	return philsroutes();
});

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
