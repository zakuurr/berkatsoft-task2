<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
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
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/customers', function () {
    return view('customers');
})->middleware(['auth'])->name('customers');

Route::get('/products', function () {
    return view('products');
})->middleware(['auth'])->name('products');

Route::get('/sales', function () {
    return view('sales');
})->middleware(['auth'])->name('sales');

Route::get('get_cart_user', [CartController::class, 'get_cart_user'])->middleware('auth')->name('get_cart_user');

require __DIR__.'/auth.php';

Route::view('/{any}', 'dashboard')
    ->middleware('auth')
    ->where('any', '.*');
