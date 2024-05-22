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
        //  Admin & Writter main page
        Route::get('','AdminHomeController@index')->name('homepage');
        Route::post('mark-as-read','AdminHomeController@markOneAsRead')->name('adminMarkAsRead');
        Route::get('mark-all-as-read','AdminHomeController@markAllAsRead')->name('adminMarkAllAsRead');

        //  Categories | Only Admin
        Route::resource('categories','CategoriesController');

        //  User | Full control for Admin | Only profile for Writter
        Route::resource('users','UserController');

        //  Post | Full control for Admin | Only post from Writter
        Route::resource('post','PostController');

        //  Notification | Full control for Admin | Only view from Writter
        Route::resource('notification','NotificationController');

        //  Image | Full control for Admin | Only image from Writter
        Route::resource('image','ImageController');

        // Comment| Only Admin
        Route::resource('comment','AdminCommentController')->only('index','edit','destroy');
    });
});

// All authenticated user
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
    // Like and unlike post
    Route::controller('User\LikeController')->group(function(){
        Route::post('/like/{post}','like')->name('like');
        Route::post('/unlike/{post}','unlike')->name('unlike');
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

// Page navigation
Route::get('/','User\UserHomeController')->name('homepage');
Route::get('post/{post}','User\ShowPostController@show')->name('showPost');
Route::get('filter','User\UserFilterController@filter')->name('postFilter');
Route::get('category/{category}','User\PostCategoryController')->name('postCategory');
Route::get('tag/{tag}','User\PostTagController')->name('postTag');


// Only for testing purpose
Route::get('/test',function(){
    return view('test');
});
