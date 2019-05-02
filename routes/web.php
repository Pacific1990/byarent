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
/* 
Route::get('/', function () {
    return view('welcome');
});
 */

Route::get('', 'WelcomeController@index');
Route::get('rent', 'WelcomeController@rent');
Route::get('sale', 'WelcomeController@sale');
Route::get('contact', 'WelcomeController@contact');
Route::get('favorite', 'WelcomeController@favorite');
Route::get('cart', 'WelcomeController@cart');
Route::get('insert-cart/{id}', 'WelcomeController@insert_cart');
Route::get('update-cart/{id}', 'WelcomeController@update_cart');
Route::get('remove-cart/{id}', 'WelcomeController@remove_cart');
Route::get('empty-cart', 'WelcomeController@empty_cart');
Route::get('detail/{id}', 'WelcomeController@detail');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('order', 'HomeController@order');

Route::resource('houses', 'HouseController');
Route::get('houses/show/{id}', 'HouseController@show');
Route::get('houses/edit/{id}', 'HouseController@edit');

Route::resource('orders', 'OrderController');
Route::resource('users', 'UserController');
Route::get('users/show/{id}', 'UserController@show');
Route::get('users/edit/{id}', 'UserController@edit');
Route::resource('groups', 'GroupController');
Route::get('groups/show/{id}', 'GroupController@show');
Route::get('groups/edit/{id}', 'GroupController@edit');
