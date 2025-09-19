<?php
//
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\PlaydateController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HostController;
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

//Route::get('/playdate', [PlaydateController::class, 'index']);

// Routes for User, Host and Intention
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');

// Complete Host routes
Route::get('/host', [HostController::class, 'index'])->name('host.index');
Route::get('/host/create', [HostController::class, 'create'])->name('host.create');
Route::post('/host', [HostController::class, 'store'])->name('host.store');
Route::get('/host/{id}', [HostController::class, 'show'])->name('host.show');
Route::get('/host/{id}/edit', [HostController::class, 'edit'])->name('host.edit');
Route::put('/host/{id}', [HostController::class, 'update'])->name('host.update');
Route::delete('/host/{id}', [HostController::class, 'destroy'])->name('host.destroy');

// Intention routes
Route::get('/intention', [IntentionController::class, 'index'])->name('intention.index');
Route::get('/intention/create', [IntentionController::class, 'create'])->name('intention.create');
Route::post('/intention', [IntentionController::class, 'store'])->name('intention.store');
Route::get('/intention/{id}', [IntentionController::class, 'show'])->name('intention.show');
Route::get('/intention/{id}/edit', [IntentionController::class, 'edit'])->name('intention.edit');
Route::put('/intention/{id}', [IntentionController::class, 'update'])->name('intention.update');
Route::delete('/intention/{id}', [IntentionController::class, 'destroy'])->name('intention.destroy');

//Routes for Event

Route::post('event', [EventController::class, 'store'])->name('event.store');
Route::get('event/create', [EventController::class, 'create'])->name('event.create');
Route::get('event/{id}', [EventController::class, 'show'])->name('event.show');
Route::get('event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
Route::put('event/{id}', [EventController::class, 'update'])->name('event.update');
Route::delete('event/{id}', [EventController::class, 'destroy'])->name('event.destroy');


