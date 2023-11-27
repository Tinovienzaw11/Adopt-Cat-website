<?php

use App\Http\Controllers\CatTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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

Route::get('/',  [HomeController::class, 'index']);
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::name('dashboard.')
    ->prefix('/dashboard')
    ->middleware('auth')
    ->group(function() {
        Route::get('/', [DashboardController::class, 'index'])->name('index');

        Route::resource('cat-type', '\App\Http\Controllers\CatTypeController');
        Route::resource('cat', '\App\Http\Controllers\CatController');
    });
