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

Route::get('/', "HomeController@homePage");



Route::get('/home', 'HomeController@index')->name('home');
Auth::routes();

Route::get('/admin/login','Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login','Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/admin','AdminController@index')->name('admin.dashboard');

Route::post('/createProduct','ProductController@createProduct')->name('createProduct');

Route::get('/homepage','HomeController@homePage')->name('home_Page');

Route::post('/search','SearchController@search')->name('search');

Route::get('/test/{title}/{body}','TestController@test');

Route::get('/productDetail/{id}','ProductController@detail')->name('productDetail');

Route::post('/create-payment','PaymentController@create')->name('create-payment');

Route::get('/execute-payment/{product_id}/{user_id}','PaymentController@execute');

Route::get('/paypal','PaymentController@afterPayment');

Route::post('/postReview','ReviewController@addReview');

Route::post('/getReviews','ReviewController@getReviews');