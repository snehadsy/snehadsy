<?php

use App\Http\Controllers\schoolController;
use App\Http\Controllers\SchoolController as ControllersSchoolController;
use App\Models\School;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ControllersSchoolController::class, 'register'])->name('register');
Route::get('/register-store', [ControllersSchoolController::class, 'registerStore'])->name('register.store');
// Route::get('/', [ControllersSchoolController::class, 'register'])->name('register');
