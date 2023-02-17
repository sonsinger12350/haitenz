<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ComicController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\AuthorController;

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
Route::get('/the-loai/{slug}', [IndexController::class,'cat']);
Route::get('/truyen/{slug}', [IndexController::class,'comic'])->name('truyen');
Route::get('/tac-gia/{slug}', [IndexController::class,'author'])->name('tac-gia');
Route::get('/theo-doi', [IndexController::class,'follow_list'])->name('theo-doi');

Auth::routes();

Route::get('/admin', [AdminController::class, 'index'])->name('admin');
Route::resource('admin/truyen', ComicController::class);
Route::resource('admin/danh-muc', CategoryController::class);
Route::resource('admin/chapter', ChapterController::class);
Route::resource('admin/tac-gia', AuthorController::class);
Route::put('admin/update-cat/{id}', [CategoryController::class, 'update_cat'])->name("update-cat");
Route::put('admin/update-comic/{id}', [ComicController::class, 'update_comic'])->name("update-comic");
Route::put('admin/update-author/{id}', [AuthorController::class, 'update_author'])->name("update-author");
Route::put('follow/{id}', [IndexController::class, 'follow'])->name("follow");