<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookInventoryController;
use App\Http\Controllers\AdminController;
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

Route::view('/', 'index');

Route::group(['prefix' => 'adminPanel'], function(){

    Route::view('/', 'index')->middleware('admin.auth')->name('adminPanel');
    Route::view('/LogIn', 'index')->middleware('session.existance.check')->name('logIn'); 
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout')->middleware('admin.auth');
    Route::view('/add', 'index')->middleware('admin.auth')->name('add');
    Route::view('/{isbn}/edit', 'index')->middleware('admin.auth')->name('edit');
    Route::get('/{filterType}/filter', [AdminController::class, 'filter'])->name('filter')->middleware('admin.auth');

    Route::post('/auth', [AdminController::class, 'auth'])->name('auth');
});
