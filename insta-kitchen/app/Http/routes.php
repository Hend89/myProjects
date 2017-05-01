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
// Authontication routes
Route::get('auth/login', ['as' =>'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);

// Registration Routes
Route::get('auth/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset routs
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');


// Pages 
Route::get('/', 'PagesController@index');
Route::get('about', 'PagesController@getAbout');
Route::get('contact', 'PagesController@getContact');
Route::get('pages.index', ['uses' => 'PagesController@index', 'as' => 'pages.index']);




// Posts
Route::resource('posts', 'PostController');
Route::any('post/delete','PostController@delete_post');
Route::get('posts/{user_id}/index', ['uses' => 'PostController@index', 'as' => 'posts.index']);
//Route::get('posts/{user_id}/show', ['uses' => 'PostController@show', 'as' => 'posts.show']);


// Comments
Route::post('comments/{post_id}', ['uses' => 'CommentsController@store', 'as' => 'comments.store']);
Route::get('comments/{id}/edit', ['uses' => 'CommentsController@edit']);
Route::put('comments/{id}', ['uses' => 'CommentsController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}', ['uses' => 'CommentsController@destroy', 'as' => 'comments.destroy']);
//Route::get('comments/{id}/delete', ['uses' => 'CommentsController@delete', 'as' => 'comments.delete']);

//Categories
Route::resource('categories', 'CategoryController', ['except' => ['create']]);
Route::resource('tags', 'TagController', ['except' => ['create']]);

//Notification
Route::resource('notifications', 'NotificationController');
//Route::post('notifications/{user_id}', ['uses' => 'CommentsController@index', 'as' => 'comments.index']);
Route::post('notifications/{post_id}', ['uses' => 'NotificationController@store', 'as' => 'notifications.store']);



// Languages
