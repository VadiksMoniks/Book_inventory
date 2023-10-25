<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookInventoryController;
use App\Http\Controllers\AdminController;

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

Route::get('/books', [BookInventoryController::class, 'index'])->name('api/books');

Route::post('/books/store', [AdminController::class, 'store'])->name('store');
Route::put('/books/update', [AdminController::class, 'update'])->name('update');
Route::delete('/books/{isbn}/delete', [AdminController::class, 'destroy'])->name('destroy');