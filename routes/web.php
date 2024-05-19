<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\JasaController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MekanikController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerbaikanController;

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

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/', [LoginController::class, 'authenticate'])->name('auth');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('store.register');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/cetaknota/{id_perbaikan}', [PerbaikanController::class, 'show'])->name('cetaknota');
Route::post('/dashboard/perbaikan', [PerbaikanController::class, 'store'])->name('store.perbaikan');
Route::put('/dashboard/perbaikan/{id_perbaikan}', [PerbaikanController::class, 'update'])->name('update.perbaikan');
Route::delete('/dashboard/perbaikan/detele/{id_perbaikan}', [PerbaikanController::class, 'destroy'])->name('destroy.perbaikan');

Route::get('/dashboard/item', [ItemController::class, 'index'])->name('item');
Route::post('/dashboard/item', [ItemController::class, 'store'])->name('store.item');
Route::put('/dashboard/item/{id_item}', [ItemController::class, 'update'])->name('update.item');
Route::delete('/dashboard/item/detele/{id_item}', [ItemController::class, 'destroy'])->name('destroy.item');

Route::get('/dashboard/jasa', [JasaController::class, 'index'])->name('jasa');
Route::post('/dashboard/jasa', [JasaController::class, 'store'])->name('store.jasa');
Route::put('/dashboard/jasa/{id_jasa}', [JasaController::class, 'update'])->name('update.jasa');
Route::delete('/dashboard/jasa/detele/{id_jasa}', [JasaController::class, 'destroy'])->name('destroy.jasa');

Route::get('/dashboard/mekanik', [MekanikController::class, 'index'])->name('mekanik');
Route::post('/dashboard/mekanik', [MekanikController::class, 'store'])->name('store.mekanik');
Route::put('/dashboard/mekanik/{id_mekanik}', [MekanikController::class, 'update'])->name('update.mekanik');
Route::delete('/dashboard/mekanik/detele/{id_mekanik}', [MekanikController::class, 'destroy'])->name('destroy.mekanik');
