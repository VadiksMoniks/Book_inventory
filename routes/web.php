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

Route::get('/adminPanel', [AdminController::class, 'index'])->name('adminPanel');
Route::get('/LogIn', [AdminController::class, 'LogIn'])->name('logIn');
Route::get('/logout', [AdminController::class, 'logout'])->name('logout');
Route::get('/adminPanel/add', [AdminController::class, 'addBook'])->name('add');
Route::get('/adminPanel/{isbn}/edit', [AdminController::class, 'edit'])->name('edit');
Route::get('/adminPanel/{filterType}/filter', [AdminController::class, 'filter'])->name('filter');

Route::post('/admin/auth', [AdminController::class, 'auth'])->name('auth');
Route::post('/admin/books/store', [AdminController::class, 'store'])->name('store');
Route::put('/admin/books/update', [AdminController::class, 'update'])->name('update');
Route::delete('/admin/books/{isbn}', [AdminController::class, 'destroy'])->name('destroy');