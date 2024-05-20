<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::group(['prefix'=>'admin/','namespace'=>'Admin', 'as'=>'admin.'],function(){ // Update middleware later
    Route::group(['middleware'=>'admin'],function(){
        //  Admin main page
        Route::get('','AdminHomeController@index')->name('homepage');
        Route::post('mark-as-read','AdminHomeController@markOneAsRead')->name('adminMarkAsRead');
        Route::get('mark-all-as-read','AdminHomeController@markAllAsRead')->name('adminMarkAllAsRead');
        //  Categories
        Route::resource('categories','CategoriesController');
        //  User
        Route::resource('users','UserController');
        //  Post
        Route::resource('post','PostController');
        //  Notification
        Route::resource('notification','NotificationController');
        //  Image
        Route::resource('image','ImageController');
    });
});

// User Notification
Route::group(['middleware'=>'auth'],function(){
    Route::post('/mark-as-read','UserNotificationController@markOneAsRead')->name('markAsRead');
    Route::get('/mark-all-read','UserNotificationController@markAllAsRead')->name('markAllRead');
});



// Authentication
Route::get('login','AuthController@Login')->name('login');
Route::post('login','AuthController@pLogin')->name('pLogin');
Route::get('register','AuthController@register')->name('register');
Route::post('register','AuthController@pRegister')->name('pRegister');
Route::get('logout','AuthController@Logout')->name('logout');

// Homepage
Route::get('/','User\UserHomeController')->name('homepage');
Route::get('post/{post}','User\ShowPostController@show')->name('showPost');
Route::get('filter','User\UserFilterController@filter')->name('postFilter');
Route::get('category/{category}','User\PostCategoryController')->name('postCategory');
Route::get('tag/{tag}','User\PostTagController')->name('postTag');



// Test
Route::get('/test',function(){
    return view('test');
});
// Post search & filter