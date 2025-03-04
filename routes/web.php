<?php

use App\Models\Agenda;
use App\Filament\Pages\SubmitSurvey;
use Illuminate\Support\Facades\Route;
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

Route::get('/', [AgendaController::class, 'index'])->name('welcome');
// Route::get('/', function () {
//     $agendas = Agenda::orderBy('tanggal_pelaksanaan', 'asc')->get();
//     return view('welcome', compact('agendas'));
// });

Route::get('/agenda/{slug}', [AgendaController::class, 'show'])->name('agenda.show');

// Route::post('/notifications/read-all', function () {
//     auth()->user()->unreadNotifications->markAsRead();

//     return response()->json(['message' => 'Semua notifikasi telah dibaca']);
// })->name('notifications.read-all');

// Route::get('/survey/{survey}', SubmitSurvey::class)->name('filament.pages.submit-survey');

Route::get('/survey/{slug}', [SurveyController::class, 'show'])->name('survey.show');
Route::post('/survey/{slug}', [SurveyController::class, 'submit'])->name('survey.submit');

Route::get('/daftar-hadir/{slug}', [PesertaController::class, 'show'])->name('peserta.show');
Route::post('/daftar-hadir/{slug}', [PesertaController::class, 'store'])->name('peserta.store');

// Route::get('agendas/{id}', [AgendaController::class, 'show']);


// Route::get('agenda-landing', [AgendaController::class, 'index']);
// Route::get('/', [AgendaController::class, 'index'])->name('agenda.index');
