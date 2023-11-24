<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\UserController;
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

Route::get('/', [MainController::class, 'home']);
Route::get('/page/register', [MainController::class, 'pageRegister']);
Route::post('/register', [MainController::class, 'register']);
Route::get('/page/login', [MainController::class, 'pageLogin']);
Route::post('/login', [MainController::class, 'login']);

Route::middleware(['auth'])->group(function() {
    
    Route::get('/logout', [MainController::class, 'logout']);
    
});

Route::middleware(['client'])->group(function() {
    
    Route::post('/booking', [BookingController::class, 'Booking']);
    Route::get('/page/booking', [BookingController::class, 'pageBooking']);
    Route::get('/return/{booking}', [BookingController::class, 'Return']);

});

Route::middleware(['admin'])->group(function() {

    Route::resource('/manage/user', UserController::class)->except(['create', 'show', 'edit']);
    Route::resource('/manage/car', CarController::class)->except(['create', 'show', 'edit']);

});


