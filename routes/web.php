<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/survey', [SurveyController::class, 'index'])->name('survey.index');
Route::post('/survey/store', [SurveyController::class, 'store'])->name('survey.store');