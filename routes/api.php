<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::namespace('Front')->group(function(){
    Route::prefix('auth')->group(function(){
        Route::post('register', 'AuthController@register');
        Route::post('login', 'AuthController@login');
        Route::get('refresh', 'AuthController@refresh');
        Route::group(['middleware' => 'auth:api'], function(){
            Route::get('user', 'AuthController@user');
            Route::post('logout', 'AuthController@logout');
        });
    });
    Route::get('scenes', 'ApiController@getScenes');
    Route::get('blogs', 'ApiController@getBlogs');
    Route::post('blogsByPagination', 'ApiController@getBlogsByPagination');
    Route::post('getBlogsByCategory', 'ApiController@getBlogsByCategory');
    Route::get('blog/{id}', 'ApiController@getBlog');
    Route::post('other-blogs', 'ApiController@getOtherBlogs');
    Route::post('new-blogs', 'ApiController@getNewBlogs');

    Route::get('categories', 'ApiController@getCategories');
    Route::get('blog-categories', 'ApiController@getBlogCategories');

    Route::post('submit-review', 'ApiController@submitReview');
    Route::post('app-list', 'ApiController@getAppList');

    Route::get('get-app-detail/{id}', 'ApiController@getAppDetail');
    Route::post('can-leave-comment', 'ApiController@canLeaveComment');
    Route::post('recommend', 'ApiController@recommend');

    Route::post('get-new-comments', 'ApiController@getNewComments');
    Route::post('update-profile', 'ApiController@updateProfile');
    Route::post('change-password', 'ApiController@changePassword');
    Route::post('get-my-reviews', 'ApiController@getMyReviews');
    Route::get('get-new-apps', 'ApiController@getNewApps');

    Route::post('update-blog-visit-count', 'ApiController@updateBlogVisitCount');
});
