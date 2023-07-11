<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
	CategoryController,
	DashboardController,
	LoginController,
	PostController,
	ProfileController
};

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

Route::get('/', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'loginSubmit'])->name('login.submit');

Route::middleware('admin.auth')->group(function () {

	Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

	Route::get('post', [PostController::class, 'index'])->name('post.index');
	Route::get('post/create', [PostController::class, 'create'])->name('post.create');
	Route::post('post/store', [PostController::class, 'store'])->name('post.store');
	Route::get('post/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
	Route::patch('post/update/{id}', [PostController::class, 'update'])->name('post.update');
	Route::get('post/delete/{id}', [PostController::class, 'destroy'])->name('post.delete');

	Route::get('category', [CategoryController::class, 'index'])->name('category');
	Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
	Route::post('category/store', [CategoryController::class, 'store'])->name('category.store');
	Route::get('category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
	Route::patch('category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
	Route::get('category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.delete');

	Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
	Route::post('profile/update', [ProfileController::class, 'profileUpdate'])->name('profile.update');

	Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
