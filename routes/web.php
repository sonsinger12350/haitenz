<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\IndexController;

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

Route::get('/', [IndexController::class,'index']);

Auth::routes();

Route::get('/admin', [HomeController::class, 'index'])->name('admin');
Route::resource('admin/truyen', ComicController::class);
Route::resource('admin/danh-muc', CategoryController::class);
Route::resource('admin/chapter', ChapterController::class);
Route::put('admin/update-cat/{id}', [CategoryController::class, 'update_show'])->name("update-cat");
