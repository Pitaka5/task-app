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
Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', ['uses' => 'TaskController@index', 'as' => 'home.index']);

    Route::resource('task', 'TaskController', ['names' => [
        'index' => 'task.index',
        'create' => 'task.create',
        'store' => 'task.store',
        'destroy' => 'task.destroy',
    ]]);

    Route::post('/task/export', ['uses' => 'TaskController@export', 'as' => 'task.export']);
});
