<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

  Route::controller('auth/password', 'Auth\PasswordController',[
    'getEmail' => 'auth.password.email',
    'getReset' => 'auth.password.reset'
  ]);
  Route::controller('auth', 'Auth\AuthController',[
    'getLogin' => 'auth.login',
    'getLogout' => 'auth.logout',
    'getRegister'=>'auth.register'
  ]);

  Route::get('/account', ['as'=>'backend.account.index', 'uses'=>'Backend\AccountController@index']);
  Route::put('/account/{users}', ['as'=>'backend.account.update', 'uses'=>'Backend\AccountController@update']);
  Route::get('/account/settings', ['as'=>'backend.account.settings', 'uses'=>'Backend\AccountController@settings']);
  Route::get('/account/address', ['as'=>'backend.account.address', 'uses'=>'Backend\AccountController@address']);
  Route::put('/account/address/{users}/store', ['as'=>'backend.account.address.store', 'uses'=>'Backend\AccountController@addressCreate']);

  Route::get('/account/administrator', ['as'=>'admin.index', 'uses'=>'Backend\Admin\AdminController@index']);
  Route::get('/account/administrator/site/views', ['as'=>'admin.site.views', 'uses'=>'Backend\Admin\AdminController@visits']);
  Route::delete('/account/administrator/activities/{activities}/destroy', ['as'=>'admin.activities.destroy', 'uses'=>'Backend\Admin\AdminController@destroyActivity']);
  Route::delete('/account/administrator/activities/clear', ['as'=>'admin.activities.clear', 'uses'=>'Backend\Admin\AdminController@cleareActivityLog']);

  Route::get('dashboard/users/{users}/confirm', ['as'=>'dashboard.admin.users.confirm','uses'=>'Backend\Admin\UsersController@confirm' ]);
  Route::resource('dashboard/admin/users', 'Backend\Admin\UsersController');

  Route::get('dashboard/pages/{pages}/confirm', ['as'=>'dashboard.admin.pages.confirm','uses'=>'Backend\Admin\PagesController@confirm' ]);

  Route::resource('dashboard/admin/pages', 'Backend\Admin\PagesController', ['except'=>['show']]);


  Route::get('dashboard/staff', ['as'=>'dashboard.staff.index','uses'=>'Backend\StaffController@index' ]);
  // Route::get('/', function () {
  //     return view('welcome');
  // });
  Route::get('dashboard/blog/{posts}/confirm', ['as'=>'dashboard.admin.blog.confirm','uses'=>'Backend\Admin\BlogController@confirm' ]);
  Route::resource('dashboard/admin/blog', 'Backend\Admin\BlogController', ['except'=>['show']]);



  // Route::get('dashboard/admin/vehicles/{type}/{id}/show', ['as'=>'dashboard.admin.vehicles.show','uses'=>'Backend\Admin\VehiclesController@show' ]);
  Route::get('dashboard/admin/vehicles/{id}/confirm', ['as'=>'dashboard.admin.vehicles.confirm','uses'=>'Backend\Admin\VehiclesController@confirm' ]);
  Route::post('dashboard/admin/vehicles/{id}/assign/route', ['as'=>'dashboard.admin.vehicles.assignRoute','uses'=>'Backend\Admin\VehiclesController@assignRoute' ]);
  Route::post('dashboard/admin/vehicles/{id}/assign/bus/driver', ['as'=>'dashboard.admin.vehicles.assignDriver','uses'=>'Backend\Admin\VehiclesController@assignDriver' ]);
  Route::post('dashboard/admin/vehicles/{id}/delete/bus/driver', ['as'=>'dashboard.admin.vehicles.deattachDriver','uses'=>'Backend\Admin\VehiclesController@deattachDriver' ]);
  Route::post('dashboard/admin/vehicles/{id}/assign/generated/fleet_number', ['as'=>'dashboard.admin.vehicles.assignFleet','uses'=>'Backend\Admin\VehiclesController@assignFleet' ]);
  Route::resource('dashboard/admin/vehicles', 'Backend\Admin\VehiclesController',  ['except'=>['show']]);

  Route::get('dashboard/drivers/{drivers}/confirm', ['as'=>'dashboard.admin.drivers.confirm','uses'=>'Backend\Admin\DriversController@confirm' ]);
  Route::resource('dashboard/admin/drivers', 'Backend\Admin\DriversController', ['except'=>['show']]);

  Route::get('dashboard/admin/districts/{id}/confirm', ['as'=>'dashboard.admin.districts.confirm','uses'=>'Backend\Admin\DistrictsController@confirm' ]);
  Route::resource('dashboard/admin/districts', 'Backend\Admin\DistrictsController',  ['except'=>['show']]);

  Route::get('dashboard/admin/locations/{id}/confirm', ['as'=>'dashboard.admin.locations.confirm','uses'=>'Backend\Admin\LocationsController@confirm' ]);
  Route::resource('dashboard/admin/locations', 'Backend\Admin\LocationsController',  ['except'=>['show']]);

  Route::get('dashboard/admin/troutes/{id}/confirm', ['as'=>'dashboard.admin.troutes.confirm','uses'=>'Backend\Admin\TRoutesController@confirm' ]);
  Route::resource('dashboard/admin/troutes', 'Backend\Admin\TRoutesController',  ['except'=>['show']]);

  Route::get('dashboard/admin/types/{id}/confirm', ['as'=>'dashboard.admin.types.confirm','uses'=>'Backend\Admin\TypesController@confirm' ]);
  Route::resource('dashboard/admin/types', 'Backend\Admin\TypesController');

  Route::post('messages/contact/driver', ['as'=>'messages.messageDriver','uses'=>'MessagesController@messageDriver' ]);

  Route::resource('backend/images', 'Backend\ImagesController', ['except'=>['show']]);

  Route::resource('account/orders', 'Backend\OrdersController', ['except'=>['create', 'edit']]);
  Route::resource('dashboard/admin/orders', 'Backend\Admin\OrdersController', ['except'=>['create']]);
});
