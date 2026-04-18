<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PetController;

$pets = \App\Models\Pet::latest('id')->limit(10)->get();

Route::view('/', 'welcome', compact('pets'))->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

Route::resource('pets', 'App\Http\Controllers\PetController')->middleware('auth')->names('pets');

Route::patch('pets/{id}/adopt', [PetController::class, 'adopt'])->name('pets.adopt');
