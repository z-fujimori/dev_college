<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SpeechController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostController;
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

Route::get('/yy', function(){
    return view('speech.a');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',  [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::post('/posts', [PostController::class, 'store']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/speech', [SpeechController::class, 'index'])->name('say');

Route::view('/calendar', 'calendar/calendar')->name('calendar');
Route::post('/calendar', [EventController::class, 'store'])->name('event.store');
Route::post('/calendar/event', [EventController::class, 'getEvent'])->name('event.get');
Route::post('/calendar/{event}', [EventController::class, 'update'])->name('event.update');

require __DIR__.'/auth.php';

Route::get('/chat', [ChatController::class, 'index'])->name('chat');
Route::post('/chat', [ChatController::class, 'sendMessage'])->name('chat.post');
Route::get('/chat/{user}', [ChatController::class, 'openChat']);