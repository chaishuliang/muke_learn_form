<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::auth();
    Route::get('/home', 'HomeController@index');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web','auth']], function () {
    Route::get('student/index', ['uses' => 'StudentController@index']);
    Route::any('student/create', ['uses' => 'StudentController@create']);
    Route::any('student/save', ['uses' => 'StudentController@save']);
    Route::any('student/update/{id}', ['uses' => 'StudentController@update']);
    Route::any('student/detail/{id}', ['uses' => 'StudentController@detail']);
    Route::any('student/delete/{id}', ['uses' => 'StudentController@delete']);
});

/*
|--------------------------------------------------------------------------
| 练习 路由
|--------------------------------------------------------------------------
|
*/
//必选参数
Route::get('user/{id}', function ($id) {
    return 'User '.$id;
});

//可选参数 这种情况下需要给相应的变量指定默认值
Route::get('user/{name?}', function ($name = null) {
    return '可选参数 '.$name;
});
//where方法来约束路由参数的格式
Route::get('user/{id}/{name}', function ($id, $name) {
    //
})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);


//路由命名
Route::get('user/profile', ['as' => 'profile', function ($id) {
    return "profile";
}]);
//指定路由名称到控制器动作
Route::get('user/profile', [
    'as' => 'profile', 'uses' => 'UserController@showProfile'
]);
Route::get('user/profile', 'UserController@showProfile')->name('profile');// 推荐使用

/**
 * 路由群组
 * as 路由名公共前缀
 * prefix 路由 url前缀
 *
 */
Route::group(['as' => 'admin::'], function () {
    Route::get('dashboard', function () {
        // 路由被命名为 "admin::dashboard"
        //route('admin::dashboard')
    })->name('dashboard');
});

//如有需补充的路由，添加到Route::resource之前
Route::resource('photo', 'PhotoController');