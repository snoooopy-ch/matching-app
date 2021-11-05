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

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
    Route::get('/', function() {
        return redirect('/admin/dashboard');
    });

    Auth::routes(['register' => false]);

    Route::middleware('auth')->group(function() {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::resource('scene', 'SceneController');
        Route::resource('category', 'CategoryController');
        Route::resource('app', 'AppController');
        Route::post('/app-list', 'AppController@appList')->name('app.list');
        Route::post('/app/get-scenes', 'AppController@getScenes')->name('app.scenes');
        Route::post('/app/set-scenes', 'AppController@setScenes');
        Route::post('/app/set-category', 'AppController@setCategory');
        Route::post('/app/change-status', 'AppController@changeStatus');
        // profile
        Route::get('/profile', 'ProfileController@index')->name('profile.index');
        Route::post('/profile', 'ProfileController@update')->name('profile.update');
        Route::post('/change-password', 'ProfileController@changePassword')->name('profile.password.change');

        Route::resource('blog', 'BlogController')->except(['update']);
        Route::post('/blog-list', 'BlogController@blogList')->name('blog.list');
        Route::post('/blog/upload-thumb', 'BlogController@uploadThumb');
        Route::post('/blog/update/{id}', 'BlogController@updateBlog');

        Route::resource('user', 'UserController');
        Route::post('/user-list', 'UserController@userList')->name('user.list');

        Route::resource('blog-category', 'BlogCategoryController')->except(['create', 'show', 'edit']);
    });
});

Route::namespace('Front')->group(function() {
    Route::get('/', 'ViewController@home');
    Route::get('/login', 'ViewController@login');
    Route::get('/register', 'ViewController@register');
    Route::get('/ranking', 'ViewController@ranking');
    Route::get('/terms', 'ViewController@terms');
    Route::get('/privacy', 'ViewController@privacy');
    Route::get('/app/{id}', 'ViewController@appDetail');
    Route::get('/blogs', 'ViewController@blogs');
    // Route to handle page reload in Vue except for api routes
    Route::get('/{any}', 'ViewController@index')->where('any', 'myreviews|profile');
    Route::get('/{blog_category}', 'ViewController@blogCategory');
    Route::get('/{blog_category}/{id}', 'ViewController@blog');
});

