<?php

use App\Http\Controllers\ExcelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();

})->middleware('auth:sanctum');

Route::post('/import', [ExcelController::class, 'import'])->name('import');
