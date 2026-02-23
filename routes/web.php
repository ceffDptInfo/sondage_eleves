<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SurveyController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('Welcome');

Route::get('/dashboard', function () {
    return Inertia::render('Welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

// ----------------------------------------------------------------------

// Routes pour les élèves
Route::get('students/home', function () {
    return Inertia::render('Students/Home');
})->name('students.home');

// ----------------------------------------------------------------------

// Route pour les enseignants
// Home
Route::get('teachers/home', function () {
    return Inertia::render('Teachers/Home');
})->middleware(['auth', 'verified'])->name('teachers.home');

// Creation
Route::get('teachers/create_survey', function () {
    return Inertia::render('Teachers/Creation');
})->middleware(['auth', 'verified'])->name('teachers.create-survey');

Route::post('survey', [SurveyController::class, 'store'])->middleware(['auth', 'verified'])->name('survey.store');

// Sondages 
Route::get('teachers/probe/set_up/{id}', function ($id) {
    return Inertia::render('Teachers/Probe/Set_up', ['surveyId' => $id]);
})->middleware(['auth', 'verified'])->name('teachers.probe.set_up');

Route::get('teachers/probe/display', function () {
    return Inertia::render('Teachers/Probe/Display');
})->middleware(['auth', 'verified'])->name('teachers.probe.display');

Route::get('teachers/probe/results', function () {
    return Inertia::render('Teachers/Probe/Results_list');
})->middleware(['auth', 'verified'])->name('teachers.probe.results_list');

// Archives
Route::get('teachers/archives', function () {
    return Inertia::render('Teachers/Archives');
})->middleware(['auth', 'verified'])->name('teachers.archives');

// ----------------------------------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
