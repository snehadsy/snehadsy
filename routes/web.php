<?php

use App\Http\Controllers\studentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students', [studentController::class, 'index'])->name('students.index');
Route::get('/students/add', [studentController::class, 'add'])->name('students.add');
Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');
Route::get('/students/{id}/export', [StudentController::class, 'export'])->name('students.export');
Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');


