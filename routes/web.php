<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\SpeechController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ComentController;
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

Route::get('/dashboard',  [PostController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/index',  [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('index');
Route::post('/posts', [PostController::class, 'store']);
// Route::post('/posts/{post}'[Post])

Route::get('/coment',[ComentController::class,'allComent'])->name('coment.all');
Route::get('/coment/getChild/{coment}',[ComentController::class,'getChild'])->name('coment.getChild');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/speech', [SpeechController::class, 'index'])->name('say');

// Route::view('/calendar', 'calendar/calendar')->name('calendar');
Route::get('/calendar', [EventController::class, 'show'])->name('calendar');
Route::post('/calendar/store', [EventController::class, 'store'])->name('event.store');
Route::post('/calendar/event', [EventController::class, 'getEvent'])->name('event.get');
Route::put('/calendar/updates', [EventController::class, 'update'])->name('event.update');

Route::post('/testform', [PostController::class, 'testform']);

require __DIR__.'/auth.php';

// prefixで一括で/adminを追加、nameも区別するためにname列にnameメソッドによりはadmin.を先頭につける
Route::prefix('admin')->name('admin.')->group(function(){
    require __DIR__.'/admin.php';
});


Route::get('/chat', [ChatController::class, 'index'])->name('chat');
Route::post('/chat', [ChatController::class, 'sendMessage'])->name('chat.post');
Route::get('/chat/{user}', [ChatController::class, 'openChat']);