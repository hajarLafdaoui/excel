<?php

use App\Http\Controllers\ExcelController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/upload', [ExcelController::class, 'showUploadForm']);
// Route::post('/import', [ExcelController::class, 'import']);
