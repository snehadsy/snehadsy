<?php

use App\Http\Controllers\schoolController;
use App\Http\Controllers\studentController;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [schoolController::class, 'register'])->name('register');
Route::get('/districts/{stateId}', [schoolController::class, 'districts']);
Route::get('/cities/{districtId}', [schoolController::class, 'cities']);
Route::post('/register/store', [schoolController::class, 'registerStore'])->name('register.store');
Route::get('/login', [schoolController::class, 'login'])->name('login');
Route::post('/verify/login', [schoolController::class, 'verifyLogin'])->name('verify.login');
Route::post('/logout', [schoolController::class, 'logout'])->name('logout');
Route::get('/error', function () {
    return view('error');
})->name('error.unauthorized');



Route::middleware('check.school')->group(function () {

Route::get('/students', [studentController::class, 'index'])->name('students.index');
Route::get('/students/add', [studentController::class, 'add'])->name('students.add');
Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::post('/students/{student}/update', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::get('/students/{id}/export', [StudentController::class, 'export'])->name('students.export');
Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');


});
