<?php

use Illuminate\Support\Facades\Route;

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

//For Admin Only
Route::get('/config/users', 'AdminController@users')->name('configUsers');

Route::post('/users/setAdmin/{id}', 'UserController@setAdmin')->name('setUserAsAdmin');
Route::post('/delete/{id}', 'UserController@delete')->name('deleteUser');

//For Users
Route::get('/addPost','PostController@addForm')->name('addPostForm');
Route::post('/create','PostController@create')->name('createPost');
Route::get('/myPosts','PostController@userPosts')->name('userPosts');
Route::get('/updateForm/{id}','PostController@updateForm')->name('updatePostForm');
Route::post('/updatePost','PostController@update')->name('updatePost');
Route::post('/deletePost/{id}','PostController@delete')->name('deletePost');




