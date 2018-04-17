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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'UsersController@index')->name('view_users');

Route::get('/user/{id}/make/{role}', 'UsersController@switchUserRole');

Route::get('/user/{id}/delete', 'UsersController@destroy');

Route::get('/user/{id}/edit', 'UsersController@editUser');

Route::put('/user/{id}/edit', 'UsersController@storeEditUser');

Route::get('/user/add', 'UsersController@create')->name('add_user');

Route::post('/user/add', 'UsersController@store')->name('create_user');

Route::get('/products', 'ProductsController@index')->name('view_products');

Route::get('/product/{id}/delete', 'ProductsController@destroy')->name('delete_product');

Route::get('/product/add', 'ProductsController@create')->name('add_product');

Route::post('/product/add', 'ProductsController@store')->name('create_product');

Route::get('/product/category/add', 'ProductsCategoryController@create')->name('add_category');

Route::post('/product/category/add', 'ProductsCategoryController@store')->name('create_category');

Route::get('/order', 'OrdersController@create')->name('make_order');

Route::get('/order/history', 'OrdersController@history')->name('view_orders');

Route::post('/order', 'OrdersController@store')->name('create_order');

// Route::get('/order/{id}/approve', 'OrdersController@approve')->name('approve_order');

// Route::get('/order/{id}/unapprove', 'OrdersController@unapprove')->name('unapprove_order');
Route::get('/order/{id}/{action}', 'OrdersController@action')->name('order_action');

Route::get('/order/{id}/delete', 'OrdersController@destroy')->name('delete_order');

Route::post('/order/search/', 'OrdersController@find')->name('search_order');

Route::post('/product/search/', 'ProductsController@find')->name('search_product');

