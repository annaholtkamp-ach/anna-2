<?php
//
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\PlaydateController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HostControler;
use App\Http\Controllers\IntentionController;

Route::get('event', [\App\Http\Controllers\EventController::class, 'index'] );

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::get('/playdate', [PlaydateController::class, 'index']);
Route::get('/event', [EventController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/host', [HostControler::class, 'index']);
Route::get('/intention', [IntentionController::class, 'index']);
Route::get('event/create', [EventController::class, 'create'])->name('event.create');


