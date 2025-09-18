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

// Routes for User, Host and Intention
Route::get('/user', [UserController::class, 'index']);
Route::get('/host', [HostControler::class, 'index']);
Route::get('/intention', [IntentionController::class, 'index']);

//Routes for Event
Route::get('event/create', [EventController::class, 'create'])->name('event.create');
Route::post('event', [EventController::class, 'store'])->name('event.store');
Route::get('event/{id}', [EventController::class, 'show'])->name('event.show');
Route::get('event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
Route::put('event/{id}', [EventController::class, 'update'])->name('event.update');

Route::get('/event', [EventController::class, 'index']);
Route::get('event/{id}', [EventController::class, 'show']);
