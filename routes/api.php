<?php

use App\Http\Controllers\SchoolController;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/verify/api/login', [SchoolController::class, 'verifyLogin'])->name('api.login');
