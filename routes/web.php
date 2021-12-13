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
    $posts = exec("id");
    return view('welcome')->with('posts', $posts);
});



Route::post('/', function () {
    return view('master');
 });

// Route::post('miJqueryAjax','App\Http\Controllers\AjaxController@index');
Route::post('miJqueryAjax',function(){
    return App::call('App\Http\Controllers\AjaxController@index' , ['urlNico' => $_POST['urlNico']]);
});
