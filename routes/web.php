<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ProductsController;
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
    return view('auth.login');
});

// Login  Routes
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post');
Route::get('registration', [AuthController::class, 'registration'])->name('register');
Route::post('post-registration', [AuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('dashboard', [AuthController::class, 'dashboard']); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


// Color  Routes
Route::get('color', [ColorController::class, 'index'])->name('color');
Route::post('color.store',[ColorController::class, 'store'])->name('color.create');
Route::get('color/add',[ColorController::class, 'create'])->name('color.add');
Route::get('color.edit/{id}',[ColorController::class, 'edit'])->name('color.edit');
Route::post('color.update',[ColorController::class, 'update'])->name('color.update');
Route::get('color.delete/{id}',[ColorController::class, 'destroy'])->name('color.delete');
Route::get('color.show/{id}',[ColorController::class, 'show'])->name('color.show');

// Size  Routes
Route::get('size', [SizeController::class, 'index'])->name('size');
Route::post('size.store',[SizeController::class, 'store'])->name('size.create');
Route::get('size/add',[SizeController::class, 'create'])->name('size.add');
Route::get('size.edit/{id}',[SizeController::class, 'edit'])->name('size.edit');
Route::post('size.update',[SizeController::class, 'update'])->name('size.update');
Route::get('size.delete/{id}',[SizeController::class, 'destroy'])->name('size.delete');
Route::get('size.show/{id}',[SizeController::class, 'show'])->name('size.show');
Route::get('size/fetch_data',[SizeController::class, 'fetchData'])->name('size.fetch_data');

// Products  Routes
Route::get('product', [ProductsController::class, 'index'])->name('product');
Route::post('product.store',[ProductsController::class, 'store'])->name('product.create');
Route::get('product/add',[ProductsController::class, 'create'])->name('product.add');
Route::get('product.edit/{id}',[ProductsController::class, 'edit'])->name('product.edit');
Route::post('product.update',[ProductsController::class, 'update'])->name('product.update');
Route::get('product.show/{id}',[ProductsController::class, 'show'])->name('product.show');

Route::get('product.delete/{id}',[ProductsController::class, 'destroy'])->name('product.delete');