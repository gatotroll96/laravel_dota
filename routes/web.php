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

//HOME - INDEX
Route::get('/', 'App\Http\Controllers\dota\IndexController@index')->name('dota.home');












// ADMIN LOGIN
Route::get('test', 'App\Http\Controllers\admin\UserController@index');
Route::get('admin/login', 'App\Http\Controllers\admin\UserController@login');
Route::post('admin/checkLogin', 'App\Http\Controllers\admin\UserController@checkLogin')->name('admin.checkLogin');
Route::get('admin/permisson', function () {
    return view('admin.error.permisson');
});

//ajax category
Route::post('testajax', 'App\Http\Controllers\dota\IndexController@ajaxCategory');


//ADMIN

Route::middleware(['adminLogin'])->prefix('admin')->group(function () {

	Route::get('/', function () {
	    return view('admin.layout.admin-home');
	});

	//category
	Route::group(['prefix'=>'category'], function(){		
		//list
		Route::get('/', 'App\Http\Controllers\admin\CategoryController@index');
		//add
		Route::get('add', 'App\Http\Controllers\admin\CategoryController@getadd');
		Route::post('add', 'App\Http\Controllers\admin\CategoryController@postadd');

		Route::get('edit/{id}', 'App\Http\Controllers\admin\CategoryController@getedit')->name('category.edit');
		Route::post('edit/{id}', 'App\Http\Controllers\admin\CategoryController@postedit')->name('category.edit.post');

		Route::post('delete', 'App\Http\Controllers\admin\CategoryController@destroy');
	});

	//post

	Route::group(['prefix'=>'post'], function(){		
		//list
		Route::get('/', 'App\Http\Controllers\admin\PostController@index');
		//add
		Route::get('add', 'App\Http\Controllers\admin\PostController@create');
		Route::post('add', 'App\Http\Controllers\admin\PostController@add');

		Route::get('edit/{id}', 'App\Http\Controllers\admin\PostController@edit')->name('post.edit');
		Route::post('edit/{id}', 'App\Http\Controllers\admin\PostController@update')->name('post.save.edit');

		Route::post('delete', 'App\Http\Controllers\admin\PostController@destroy');
	});

	Route::get('/logout', 'App\Http\Controllers\admin\UserController@logout');	
});




