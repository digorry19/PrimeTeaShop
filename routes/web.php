<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\ClientProductController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\UserController;

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

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('categories', AdminCategoryController::class);
    Route::get('/categories/count', [AdminCategoryController::class, 'count'])->name('categories.count');
    Route::resource('products', AdminProductController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::patch('/users/{user}/activate', [UserController::class, 'activate'])->name('users.activate');
    Route::patch('/users/{user}/deactivate', [UserController::class, 'deactivate'])->name('users.deactivate');
});

// Route cho client
// Route lọc sản phẩm theo danh mục
Route::middleware(['auth'])->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'index'])->name('client.dashboard');
    Route::get('/client/products', [ClientProductController::class, 'index'])->name('client.products.index');
    Route::get('/client/products/category/{category}', [ClientProductController::class, 'filterByCategory'])
        ->name('client.products.filterByCategory');
    Route::get('/client/products/{product}', [ClientProductController::class, 'show'])->name('client.products.show');
});
Route::get('sendmail',[SendMailController::class, 'sendMail']);
