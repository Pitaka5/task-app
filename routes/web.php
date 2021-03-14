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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('task', 'TaskController', ['names' => [
        'index' => 'task.index',
        'create' => 'task.create',
        'store' => 'task.store',
        'show' => 'task.show',
        'edit' => 'task.edit',
        'update' => 'task.update',
        'destroy' => 'task.destroy',
    ]]);

    Route::post('/export', ['uses' => 'TaskController@export', 'as' => 'task.export']);
});
