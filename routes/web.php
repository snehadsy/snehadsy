<?php

use App\Http\Controllers\studentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\schoolController;
 use App\Http\Controllers\SchoolController as ControllersSchoolController;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [ControllersSchoolController::class, 'register'])->name('register');
Route::post('/register/store', [ControllersSchoolController::class, 'registerStore'])->name('register.store');
Route::get('/login', [ControllersSchoolController::class, 'login'])->name('login');
Route::post('/verify/login', [ControllersSchoolController::class, 'verifyLogin'])->name('verify.login');
Route::post('/logout', [ControllersSchoolController::class, 'logout'])->name('logout');



Route::middleware('check.school')->group(function () {
    
Route::get('/students', [studentController::class, 'index'])->name('students.index');
Route::get('/students/add', [studentController::class, 'add'])->name('students.add');
Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::get('/students/{id}/export', [StudentController::class, 'export'])->name('students.export');
Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');

});
