<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('todos')->as('todos.')->controller(TodoController::class)->group(function () {
    Route::get('index',  'index')->name('index');
    Route::get('create',  'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('todos/show/{id}', 'show')->name('show');
    Route::get('todos/{id}/edit',  'edit')->name('edit');
    Route::put('todos/update',  'update')->name('update');
    Route::delete('todos/destroy',  'destroy')->name('destroy');

   
 
});