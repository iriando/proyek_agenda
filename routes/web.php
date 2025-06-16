<?php

use App\Models\Agenda;
use Mews\Captcha\Facades\Captcha;
use App\Filament\Pages\DetailReport;
use App\Filament\Pages\SubmitSurvey;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SlidoController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\PesertaController;

// use App\Http\Controllers\Api\AgendaController;

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

Route::get('/captcha-image', function () {
    return response()->json([
        'captcha' => captcha_img('flat'),
    ]);
});


Route::get('/', [AgendaController::class, 'index'])->name('welcome');

Route::get('/agenda/{slug}', [AgendaController::class, 'show'])->name('agenda.show');

Route::get('/slido/{slug}', [SlidoController::class, 'show'])->name('slido.show');
// Route::post('/notifications/read-all', function () {
//     auth()->user()->unreadNotifications->markAsRead();

//     return response()->json(['message' => 'Semua notifikasi telah dibaca']);
// })->name('notifications.read-all');

Route::get('/agenda/{agendaSlug}/survey/{surveySlug}', [SurveyController::class, 'show'])->name('survey.show')->where('survey', '.*');

Route::post('/survey/{slug}/{survey}', [SurveyController::class, 'submit'])->name('survey.submit');

Route::get('/daftar-hadir/{slug}', [PesertaController::class, 'show'])->name('peserta.show');
Route::post('/daftar-hadir/{slug}', [PesertaController::class, 'store'])->name('peserta.store');

Route::get('/tes', function () {
    return view('layouts.app_new');
});

Route::get('/admin/detail-report/{record}', DetailReport::class)->name('filament.admin.pages.detail-report');

