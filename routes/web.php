<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\PositionsController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VoterAuthController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('positions', PositionsController::class)
    ->only(['index','store','edit','update','destroy'])
    ->middleware(['auth','verified']);

Route::resource('candidates',CandidateController::class)
    ->only(['index','store'])
    ->middleware(['auth','verified']);

Route::resource('voters',VoterController::class)
    ->only(['index','store','edit','update','destroy','castvote','login'])
    ->middleware(['auth','verified']);

// Route::get('/logintovote', function () {
//         return view('vote.votersLogin');
//         })->name('votersLogin');

// Voter Login Page
Route::get('/voter-login', [VoterAuthController::class, 'showLoginForm'])->name('voter.login');
Route::post('/voter-login', [VoterAuthController::class, 'login'])->name('voter.login.submit');




require __DIR__.'/auth.php';

// php artisan make:policy ChirpPolicy --model=Chirp
