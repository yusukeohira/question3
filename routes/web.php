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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin'],function(){
  Route::get('news/create','Admin\NewsController@add');
});


//課題３
/*「http://XXXXXX.jp/XXX というアクセスが来たときに、 
AAAControllerのbbbというAction に渡すRoutingの設定」を
書いてみてください。
Route::get('XXX','AAAController@bbb');
*/

//課題４


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//メンタリングのときの宿題　１２の課題２と3
Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('profile/create','Admin\ProfileController@add');
    //13の課題3
    Route::post('profile/create','Admin\ProfileController@create');
    //13の課題6
    Route::post('profile/edit','Admin\ProfileController@update');
    Route::get('profile/edit','Admin\ProfileController@edit');
    //課題15プロフィール一覧
    Route::get('profile','Admin\ProfileController@index');
    Route::get('news/create', 'Admin\NewsController@add');
    Route::post('news/create','Admin\NewsController@create');
    Route::get('news','Admin\NewsController@index');
    
    Route::get('news/edit','Admin\NewsController@edit');
    Route::post('news/edit','Admin\NewsController@update');
    Route::get('news/delete','Admin\NewsController@delete');
});
