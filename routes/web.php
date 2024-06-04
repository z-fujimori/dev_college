<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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

Route::view('/calendar', 'calendar/calendar');

Route::post('/calendar', [EventController::class, 'store'])->name('event.store');

Route::get('/', function () {
    return view('welcome');
});
