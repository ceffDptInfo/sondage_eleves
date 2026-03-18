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
});
// ----------------------------------------------------------------------
// Routes autres
// Adresse IP
Route::get('/ip', function () {
    return request()->ip();
});

// ----------------------------------------------------------------------

// Route pour les enseignants
// Pages
Route::get('teachers/home', function () {
    return Inertia::render('Teachers/Home');
})->middleware(['auth']);

Route::get('teachers/create_survey', function () {
    return Inertia::render('Teachers/Creation');
})->middleware(['auth']);

Route::get('teachers/probe/set_up/{id}', function ($id) {
    return Inertia::render('Teachers/Probe/Set_up', ['surveyId' => $id]);
})->middleware(['auth']);

Route::get('teachers/probe/display/{id}', function ($id) {
    return Inertia::render('Teachers/Probe/Display', ['sessionId' => $id]);
})->middleware(['auth']);

Route::get('teachers/probe/results/{id}', function ($id) {
    return Inertia::render('Teachers/Probe/Results_list', ['sessionId' => $id]);
})->middleware(['auth']);

Route::get('teachers/archives', function () {
    return Inertia::render('Teachers/Archives');
})->middleware(['auth']);

// GET
Route::get('teachers/surveys', [HomeController::class, 'getByTeacher'])->middleware(['auth']);
Route::get('teachers/survey/{id}', [ProbeController::class, 'getSurveyById'])->middleware(['auth']);
Route::get('teachers/probe/session/{id}', [ProbeController::class, 'getById'])->middleware(['auth']);
Route::get('teachers/probe/session/{id}/results', [ProbeController::class, 'getResults'])->middleware(['auth']);
Route::get('teachers/probe/session/{id}/results/close', [ProbeController::class, 'closeSession'])->middleware(['auth']);
Route::get('teachers/archives/list', [ArchivesController::class, 'getArchives'])->middleware(['auth']);

// POST
Route::post('teachers/survey', [CreationController::class, 'store'])->middleware(['auth']);
Route::post('teachers/probe/session', [ProbeController::class, 'setUp'])->middleware(['auth']);

// PATCH
Route::patch('teachers/probe/session/{id}/complete', [ProbeController::class, 'complete'])->middleware(['auth']);

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
Route::post('students/connection', [StudentsHomeController::class, 'connection'])->name('students.connection');
Route::post('students/survey/{code}/remark', [StudentsSurveyController::class, 'postRemark'])->name('students.post_remark');
Route::post('students/survey/remark/{id}/vote', [StudentsSurveyController::class, 'postVote'])->name('students.vote');

// ----------------------------------------------------------------------

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
