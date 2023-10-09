<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClsController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\ExamInfoController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\StudentInfoController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */

Route::get('/', function () {
    $brand = 'Student Management';
    return view('welcome', compact('brand'));
})->name('welcome');

Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('classes', ClsController::class);
    Route::resource('subjects', SubjectController::class);
    Route::resource('students', StudentInfoController::class);
    Route::get('student-classes', [StudentInfoController::class, 'classList'])->name('student.classes');
    Route::resource('examinfos', ExamInfoController::class);
    Route::post('exam-msg-set', [ExamInfoController::class, 'setExamMsg'])->name('exam.msg.set');
    Route::get('exam-info-status-update', [ExamInfoController::class, 'statusUpdate'])->name('exam-info-status-update');
    Route::resource('results', ResultController::class);
    Route::get('results-history', [ResultController::class, 'history'])->name('results.history');
    Route::get('send-all-sms', [ExamInfoController::class, 'sendAllSms'])->name('send.all.sms');
    Route::get('send-single-sms', [ExamInfoController::class, 'sendSingleSms'])->name('send.single.sms');
    Route::get('send-test-sms', [ExamInfoController::class, 'sendTestSms'])->name('send.test.sms');

    Route::group(['prefix' => 'export'], function () {
        Route::get('exam-participants', [ExportController::class, 'examParticipants'])->name('export.exam.participants');
        Route::get('student-template', [ExportController::class, 'studentTemplate'])->name('export.student.template');
    });

    Route::group(['prefix' => 'import'], function () {
        Route::post('exam-participants-marks', [ImportController::class, 'examParticipantsMarks'])->name('import.exam.participants.marks');
        Route::post('students', [ImportController::class, 'students'])->name('import.students');
    });

    Route::group(['prefix' => 'download'], function () {
        Route::get('exam-results', [DownloadController::class, 'examResults'])->name('download.exam.results');
    });

});

require __DIR__ . '/auth.php';
