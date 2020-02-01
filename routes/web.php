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

Route::get('/', 'IndexController@index');
Route::get('/index/json', 'IndexController@json');

Route::get('/product', 'ProductController@index');
Route::get('/product/json', 'ProductController@json');

Route::get('/detail/{id}', 'ProductController@detail');
Route::get('/product/json', 'ProductController@json');

Route::get('/buylist', 'ProductController@buylist');
Route::get('/buylist/json', 'ProductController@buylistJson');

Route::get('/productlist', 'ProductController@productlist');
Route::get('/productlist/json', 'ProductController@productlistJson');

Route::get('/categorylist/json', 'ProductController@categoryJson');
Route::get('/arealist/json', 'ProductController@areaJson');

Route::get('/profile/{id}', 'UserController@profile');
Route::get('/store/profile/{id}', 'StoreController@profile');

Route::get('/auth/json','IndexController@auth');

Route::get('/sample/mail/preview', function(){
    return new App\Mail\ProductMail();
});

Route::get('/sample/saleMail', 'MailController@saleMail');

Auth::routes();

Route::group(['middleware' => 'auth'], function(){
    Route::get('/buylist', 'ProductController@buylist');
    Route::get('/buylist/json', 'ProductController@buylistJson');
    
    Route::post('/buy/{id}', 'ProductController@buyProduct');
    
    Route::post('/cancel/{id}', 'ProductController@cancelProduct');
    
    Route::get('/profileEdit', 'UserController@edit');
    Route::get('/userProfile/json', 'UserController@userProfileJson');
    Route::post('/saveProfile/', 'UserController@saveProfile');
    
    Route::get('/mypage', 'UserController@mypage');
    
    Route::get('/cancel/json', 'ProductController@cancelJson');
});

Route::group(['prefix' => 'store', 'middleware' => 'guest:store'], function() {
    Route::get('/', function () {
        return view('store.welcome');
    });

    Route::get('login', 'store\Auth\LoginController@showLoginForm')->name('store.login');
    Route::post('login', 'store\Auth\LoginController@login');

    Route::get('register', 'store\Auth\RegisterController@showRegisterForm')->name('store.register');
    Route::post('register', 'store\Auth\RegisterController@register');

    Route::get('password/reset', 'store\Auth\ForgotPasswordController@showLinkRequestForm')->name('store.password.request');
    Route::get('password/reset/{token}', 'store\Auth\ResetPasswordController@showResetForm')->name('store.password.reset');
    
    Route::post('password/email', 'store\Auth\ForgotPasswordController@sendResetLinkEmail')->name('store.password.email');
    Route::post('password/reset', 'store\Auth\ResetPasswordController@reset')->name('store.password.update');
    
    
});

Route::group(['prefix' => 'store', 'middleware' => 'auth:store'], function(){
    Route::post('logout', 'store\Auth\LoginController@logout')->name('store.logout');
    //Route::get('mypage', 'store\MypageController@index')->name('store.mypage');
    Route::get('mypage', function () {
        return view('store.mypage');
    });
    
    Route::get('/productlist', 'ProductController@productlist');
    Route::get('/productlist/json', 'ProductController@productlistJson');
    
    Route::get('/salelist', 'ProductController@salelist');
    Route::get('/salelist/json', 'ProductController@salelistJson');
    
    Route::get('/registProduct/{id?}', 'ProductController@regist');
    Route::get('/registProductJson', 'ProductController@registJson');
    Route::post('/saveJson/{id?}', 'ProductController@saveJson');
    Route::get('/searchJan', 'ProductController@searchJan');
    
    Route::post('/deleteProduct/{id?}', 'ProductController@delete');
    
    Route::get('/profileEdit', 'StoreController@edit');
    Route::get('/storeProfile/json', 'StoreController@storeProfileJson');
    Route::post('/saveProfile/', 'StoreController@saveProfile');
    
});

Route::get('/home', 'HomeController@index')->name('home');
