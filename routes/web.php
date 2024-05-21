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



Route::group(['prefix'=>'admin/','namespace'=>'Admin', 'as'=>'admin.'],function(){ 
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
        // Comment
        Route::resource('comment','AdminCommentController');
    });
});

// User
Route::group(['middleware'=>'auth'],function(){
    // Comment
    Route::controller('User\UserCommentController')->group(function(){
        Route::post('/comment/{post}','store')->name('pComment');
        Route::delete('/comment/{comment}','destroy')->name('deleteComment');
    });
    // Notification
    Route::controller('UserNotificationController')->group(function(){
        Route::post('/mark-as-read','markOneAsRead')->name('markAsRead');
        Route::get('/mark-all-read','markAllAsRead')->name('markAllRead');
    });
});

// Authentication
Route::controller('AuthController')->group(function(){
    Route::get('login','Login')->name('login');
    Route::post('login','pLogin')->name('pLogin');
    Route::get('register','register')->name('register');
    Route::post('register','pRegister')->name('pRegister');
    Route::get('logout','Logout')->name('logout');
});

// Homepage navigation
Route::get('/','User\UserHomeController')->name('homepage');
Route::get('post/{post}','User\ShowPostController@show')->name('showPost');
Route::get('filter','User\UserFilterController@filter')->name('postFilter');
Route::get('category/{category}','User\PostCategoryController')->name('postCategory');
Route::get('tag/{tag}','User\PostTagController')->name('postTag');


// Test
Route::get('/test',function(){
    return view('test');
});