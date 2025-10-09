<?php
//
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

use App\Http\Controllers\EventController;
use App\Http\Controllers\UserController;
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



// Routes for User, Host and Intention
Route::get('/user', [UserController::class, 'index']);
Route::get('/intention', [IntentionController::class, 'index']);

//Routes for Event
// public
Route::get('event', [EventController::class, 'index'])->name('event.index');

// must be before {id}
Route::middleware('auth')->get('event/create', [EventController::class, 'create'])->name('event.create');

// show must be numeric id
Route::get('event/{id}', [EventController::class, 'show'])
    ->whereNumber('id')
    ->name('event.show');

// protected writes
Route::middleware('auth')->group(function () {
    Route::post('event', [EventController::class, 'store'])->name('event.store');
    Route::get('event/{id}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('event/{id}', [EventController::class, 'update'])->name('event.update');
    Route::delete('event/{id}', [EventController::class, 'destroy'])->name('event.destroy');
});

//Event & Intention

Route::middleware('auth')->group(function () {
    Route::post('event/{event}/intention', [IntentionController::class, 'store'])->name('intention.store');
    Route::put('event/{event}/intention/{intention}', [IntentionController::class, 'update'])->name('intention.update');
    Route::delete('event/{event}/intention/{intention}', [IntentionController::class, 'destroy'])->name('intention.destroy');
});
