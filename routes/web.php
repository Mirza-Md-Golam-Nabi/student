<?php

use App\Http\Controllers\ClsController;
use App\Http\Controllers\ProfileController;
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
});

Route::get('/dashboard', function () {
    $title = 'Dashboard';
    $brand = 'Coaching Center';
    return view('admin.dashboard', compact('title', 'brand'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('classes', ClsController::class);
    Route::resource('subjects', SubjectController::class);
});

require __DIR__ . '/auth.php';
