<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return view('home');
})->name('home');

Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'save_login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('cate', [CategoryController::class, 'show'])->name('list_cate')->middleware('auth');
Route::get('cate/create', [CategoryController::class, 'add'])->name('add_cate');
Route::post('cate/create', [CategoryController::class, 'save_add']);
Route::get('cate/edit/{cate}', [CategoryController::class, 'edit'])->name('edit_cate');
Route::post('cate/edit/{cate}', [CategoryController::class, 'save_edit']);
Route::get('cate/remove/{cate}', [CategoryController::class, 'remove'])->name('remove_cate');

Route::get('item', [ItemController::class, 'show'])->name('list_item')->middleware('auth');
Route::get('item/create', [ItemController::class, 'add'])->name('add_item')->middleware('auth');
Route::post('item/create', [ItemController::class, 'save_add']);
Route::get('item/edit/{item}', [ItemController::class, 'edit'])->name('edit_item')->middleware('auth');
Route::post('item/edit/{item}', [ItemController::class, 'save_edit']);
Route::get('item/remove/{id}', [ItemController::class, 'remove'])->name('remove_item')->middleware('auth');

Route::get('user', [UserController::class, 'show'])->name('list_user')->middleware('auth');
Route::get('user/create', [UserController::class, 'add'])->name('add_user');
Route::post('user/create', [UserController::class, 'save_add']);
Route::get('user/remove/{user}', [UserController::class, 'remove'])->name('remove_user');
Route::get('info', [UserController::class, 'edit'])->name('info_user')->middleware('auth');
Route::get('info/edit/{id}', [UserController::class, 'edit_info'])->name('edit_info');
Route::post('info/edit/{id}', [UserController::class, 'save_edit_info']);
Route::get('info/edit_pass/{id}', [UserController::class, 'edit_pass'])->name('edit_pass');
Route::post('info/edit_pass/{id}', [UserController::class, 'save_edit_pass']);
