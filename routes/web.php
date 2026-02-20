<?php

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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ----------------------------------------------------------------------
// Routes pour les élèves
Route::get('students/home', function () {
    return Inertia::render('students/Home');
})->name('students.home');

// Route pour les enseignants
Route::get('teachers/home', function () {
    return Inertia::render('teachers/Home');
})->middleware(['auth', 'verified'])->name('teachers.home');

Route::get('teachers/create_survey', function () {
    return Inertia::render('teachers/Create_survey');
})->middleware(['auth', 'verified'])->name('teachers.create-survey');

Route::get('teachers/archives', function () {
    return Inertia::render('teachers/Archives');
})->middleware(['auth', 'verified'])->name('teachers.archives');
// ----------------------------------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
