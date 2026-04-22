<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Coach\CoachController;
use App\Http\Controllers\Student\StudentController;

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        if ($role === 'admin') return redirect()->route('admin.dashboard');
        if ($role === 'coach') return redirect()->route('coach.dashboard');
        return redirect()->route('student.dashboard');
    }
    return redirect('/login');
});

// Admin Routes
// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('students', \App\Http\Controllers\Admin\StudentController::class);
    Route::resource('coaches', \App\Http\Controllers\Admin\CoachController::class);
    Route::resource('sports', \App\Http\Controllers\Admin\SportController::class);
    Route::resource('attendances', \App\Http\Controllers\Admin\AttendanceController::class)->only(['index', 'create', 'store', 'destroy']);
});

// Coach Routes
Route::middleware(['auth', 'role:coach'])->prefix('coach')->name('coach.')->group(function () {
    Route::get('/dashboard', [CoachController::class, 'dashboard'])->name('dashboard');
});

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
});

require __DIR__.'/auth.php';