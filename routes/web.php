<?php

use App\Http\Controllers\Teachers\ProbeController;
use App\Http\Controllers\Teachers\ProfileController;
use App\Http\Controllers\Teachers\SurveyController;
use App\Http\Controllers\Students\HomeController;
use App\Http\Controllers\Students\SurveyController as StudentsSurveyController;
use App\Models\Survey;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('Welcome');
// ----------------------------------------------------------------------
// Routes autres
// Adresse IP
Route::get('/ip', function () {
    return request()->ip();
})->name('ip');

// ----------------------------------------------------------------------

// Routes pour les élèves
// Pages
Route::get('students/home', function () {
    return Inertia::render('Students/Home');
})->name('students.home');

Route::get('students/survey/{code}', function ($code) {
    return Inertia::render('Students/Survey', ['code' => $code]);
})->middleware('check.student.access')->name('students.access_survey');

// GET
Route::get('students/survey/{code}/remarks', [StudentsSurveyController::class, 'getRemarks'])->name('students.get_remarks');
Route::get('students/survey/{code}/votes', [StudentsSurveyController::class, 'getVotes'])->name('students.get_votes');
Route::get('students/session/{code}', [StudentsSurveyController::class, 'getSession'])->name('students.get_session');

// POST
Route::post('students/connection', [HomeController::class, 'connection'])->name('students.connection');
Route::post('students/survey/{code}/remark', [StudentsSurveyController::class, 'postRemark'])->name('students.post_remark');
Route::post('students/survey/remark/{id}/vote', [StudentsSurveyController::class, 'postVote'])->name('students.vote');

// ----------------------------------------------------------------------

// Route pour les enseignants
// Pages
Route::get('teachers/home', function () {
    return Inertia::render('Teachers/Home');
})->middleware(['auth', 'verified'])->name('teachers.home');

Route::get('teachers/create_survey', function () {
    return Inertia::render('Teachers/Creation');
})->middleware(['auth', 'verified'])->name('teachers.create-survey');

Route::get('teachers/probe/set_up/{id}', function ($id) {
    return Inertia::render('Teachers/Probe/Set_up', ['surveyId' => $id]);
})->middleware(['auth', 'verified'])->name('teachers.probe.set_up');

Route::get('teachers/probe/display/{id}', function ($id) {
    return Inertia::render('Teachers/Probe/Display', ['surveyId' => $id]);
})->middleware(['auth', 'verified'])->name('teachers.probe.display');

Route::get('teachers/probe/results', function () {
    return Inertia::render('Teachers/Probe/Results_list');
})->middleware(['auth', 'verified'])->name('teachers.probe.results_list');

Route::get('teachers/archives', function () {
    return Inertia::render('Teachers/Archives');
})->middleware(['auth', 'verified'])->name('teachers.archives');

// GET
Route::get('teachers/surveys', [SurveyController::class, 'getByTeacher'])->middleware(['auth', 'verified'])->name('survey.get');
Route::get('teachers/survey/{id}', [SurveyController::class, 'getById'])->middleware(['auth', 'verified'])->name('survey.get');
Route::get('teachers/probe/session/{id}', [ProbeController::class, 'getById'])->middleware(['auth', 'verified'])->name('probe.session.get');

// POST
Route::post('teachers/survey', [SurveyController::class, 'store'])->middleware(['auth', 'verified'])->name('survey.store');
Route::post('teachers/probe/session', [ProbeController::class, 'setUp'])->middleware(['auth', 'verified'])->name('probe.session.store');
Route::post('teachers/probe/session/{id}/complete', [ProbeController::class, 'complete'])->middleware(['auth', 'verified'])->name('probe.session.complete');

// ----------------------------------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
