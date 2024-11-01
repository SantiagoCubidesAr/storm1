<?php

use App\Http\Controllers\AdministratorController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TutorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [AdministratorController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resources([
        'administrators' => AdministratorController::class,
        'students' =>  StudentController::class,
        'drivers' =>  DriverController::class,
        'tutors' =>  TutorController::class,
    ]);
});


Route::post('administrators/search', [AdministratorController::class, 'search']);
Route::post('students/search', [StudentController::class, 'search']);
Route::post('drivers/search', [DriverController::class, 'search']);
Route::post('tutors/search', [TutorController::class, 'search']);

require __DIR__ . '/auth.php';
