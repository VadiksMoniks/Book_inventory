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

Route::get('/index', [BookInventoryController::class, 'index'])->name('index');
Route::redirect('/', 'http://localhost/Book_inventory/laravel/public/index');

Route::group(['prefix' => 'adminPanel'], function(){

    Route::get('/', [AdminController::class, 'index'])->name('adminPanel')->middleware('admin.auth');;
    Route::get('/LogIn', [AdminController::class, 'LogIn'])->name('logIn')->middleware('session.existance.check');
    Route::get('/logout', [AdminController::class, 'logout'])->name('logout')->middleware('admin.auth');;
    Route::get('/add', [AdminController::class, 'addBook'])->name('add');
    Route::get('/{isbn}/edit', [AdminController::class, 'edit'])->name('edit')->middleware('admin.auth');;
    Route::get('/{filterType}/filter', [AdminController::class, 'filter'])->name('filter')->middleware('admin.auth');;

    Route::post('/auth', [AdminController::class, 'auth'])->name('auth');
    Route::post('/books/store', [AdminController::class, 'store'])->name('store');
    Route::put('/books/update', [AdminController::class, 'update'])->name('update');
    Route::delete('/books/{isbn}', [AdminController::class, 'destroy'])->name('destroy');
});
