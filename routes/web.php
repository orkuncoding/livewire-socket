<?php

use App\Events\Hello;
use App\Livewire\ChatHome;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/broadcastPrivate',function(){
   $mes = \App\Models\ChatMessage::find(1);

   \App\Events\MessageSent::dispatch($mes);
    return 'done';
});

Route::get( '/chat', ChatHome::class)->name( 'chat' );

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
