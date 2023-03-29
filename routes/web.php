<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', [IndexController::class, 'index']);
// Route::get('/show', [IndexController::class, 'show']);

// Route::resource('/menu', MenuController::class);
// ->only('index', 'show');

Route::get('/', [TestController::class, 'index'])
    ->name('menu.index');
Route::post('/', [TestController::class, 'store'])
    ->name('menu.store');

Route::post('/update', [TestController::class, 'update'])
    ->name('menu.update');

Route::post('/remove', [TestController::class, 'remove'])
    ->name('menu.remove');

Route::post('/order', [TestController::class, 'order'])
    ->name('menu.order');

Route::get('/checkout', [TestController::class, 'checkout'])
    ->name('menu.checkout');

Route::post('/checkout', [TestController::class, 'checkoutupdate'])
    ->name('menu.checkoutupdate');

Route::get('/checkout/{id}', [TestController::class, 'orderdisplay'])
    ->name('menu.orderdisplay');



//Auth
Route::get('login', [AuthController::class, 'create'])
    ->name('login');

Route::post('login', [AuthController::class, 'store'])
    ->name('login.store');

Route::delete('logout', [AuthController::class, 'destroy'])
    ->name('logout');
