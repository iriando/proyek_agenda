<?php

use Illuminate\Support\Facades\Route;
use App\Filament\Pages\SubmitSurvey;

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

Route::post('/notifications/read-all', function () {
    auth()->user()->unreadNotifications->markAsRead();

    return response()->json(['message' => 'Semua notifikasi telah dibaca']);
})->name('notifications.read-all');

Route::get('/survey/{survey}', SubmitSurvey::class)->name('filament.pages.submit-survey');

// Route::get('/admin/register', function(){

// })
