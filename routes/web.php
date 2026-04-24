<?php

use App\Http\Controllers\Teachers\ArchivesController;
use App\Http\Controllers\Teachers\CreationController;
use App\Http\Controllers\Teachers\HomeController;
use App\Http\Controllers\Teachers\ProbeController;
use App\Http\Controllers\Teachers\ProfileController;

use App\Http\Controllers\Students\HomeController as StudentsHomeController;
use App\Http\Controllers\Students\SurveyController as StudentsSurveyController;
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

// Route pour les enseignants
// Pages
Route::get('teachers/home', function () {
    return Inertia::render('Teachers/Home');
})->middleware(['auth', 'verified'])->name('teachers.home');

Route::get('teachers/create_survey', function () {
    return Inertia::render('Teachers/Creation');
})->middleware(['auth', 'verified'])->name('teachers.create-survey');

Route::get('teachers/survey/{id}/edit', function ($id) {
    return Inertia::render('Teachers/Edit', ['surveyId' => $id]);
})->middleware(['auth', 'verified'])->name('teachers.edit-survey');

Route::get('teachers/probe/set_up/{id}', function ($id) {
    return Inertia::render('Teachers/Probe/Set_up', ['surveyId' => $id]);
})->middleware(['auth', 'verified'])->name('teachers.probe.set_up');

Route::get('teachers/probe/display/{id}', function ($id) {
    return Inertia::render('Teachers/Probe/Display', ['sessionId' => $id]);
})->middleware(['auth', 'verified'])->name('teachers.probe.display');

Route::get('teachers/probe/results/{id}', function ($id) {
    return Inertia::render('Teachers/Probe/Results_list', ['sessionId' => $id]);
})->middleware(['auth', 'verified'])->name('teachers.probe.results_list');

Route::get('teachers/archives', function () {
    return Inertia::render('Teachers/Archives');
})->middleware(['auth', 'verified'])->name('teachers.archives');

// GET
Route::get('teachers/surveys', [HomeController::class, 'getByTeacher'])->middleware(['auth', 'verified'])->name('survey.get');
Route::get('teachers/survey/{id}', [ProbeController::class, 'getSurveyById'])->middleware(['auth', 'verified'])->name('survey.get.by_id');
Route::get('teachers/probe/session/{id}', [ProbeController::class, 'getById'])->middleware(['auth', 'verified'])->name('probe.session.get');
Route::get('teachers/probe/session/{id}/results', [ProbeController::class, 'getResults'])->middleware(['auth', 'verified'])->name('probe.session.results');
Route::get('teachers/probe/session/{id}/results/close', [ProbeController::class, 'closeSession'])->middleware(['auth', 'verified'])->name('probe.session.generatePdf');
Route::get('teachers/archives/list', [ArchivesController::class, 'getArchives'])->middleware(['auth', 'verified'])->name('teachers.archives.list');

// POST
Route::post('teachers/survey', [CreationController::class, 'store'])->middleware(['auth', 'verified'])->name('survey.store');
Route::post('teachers/probe/session', [ProbeController::class, 'setUp'])->middleware(['auth', 'verified'])->name('probe.session.store');

// PATCH
Route::patch('teachers/survey/{id}', [CreationController::class, 'update'])->middleware(['auth', 'verified'])->name('survey.update');
Route::patch('teachers/probe/session/{id}/complete', [ProbeController::class, 'complete'])->middleware(['auth', 'verified'])->name('probe.session.complete');

// DELETE
Route::delete('teachers/survey/{id}', [HomeController::class, 'destroy'])->middleware(['auth', 'verified'])->name('survey.delete');

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
Route::get('students/connection/{code}', [StudentsHomeController::class, 'connection'])->name('students.connection.get');


// POST
Route::post('students/connection', [StudentsHomeController::class, 'connection'])->name('students.connection.post');
Route::post('students/survey/{code}/remark', [StudentsSurveyController::class, 'postRemark'])->name('students.post_remark');
Route::post('students/survey/remark/{id}/vote', [StudentsSurveyController::class, 'postVote'])->name('students.post_vote');

// ----------------------------------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
