<?php

use App\Http\Controllers\CollageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});
Route::get('/', [CollageController::class, "index"])->name("index");
Route::get('collage/{collage}', [CollageController::class, "schedule"])->name('schedule');

Route::get('/pdf/{id}', [\App\Http\Controllers\PDFController::class, "index"])->name("pdf");

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth:doctor'])->group(function () {
    Route::get("/lectures", \App\Livewire\DoctorLectures::class)->name("lectures");
    Route::get("/lectures/{day}", \App\Livewire\DoctorLecturesPerDay::class)->name("lectures-per-day");
});

require __DIR__ . '/auth.php';
