<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuestionnaireController;

// Public routes
// Questionnaire routes
Route::prefix('questionnaire')->name('api.questionnaire.')->group(function () {
    Route::get('/', [QuestionnaireController::class, 'index'])->name('index');
    Route::get('/{slug}', [QuestionnaireController::class, 'show'])->name('show');
    Route::post('/{slug}/submit', [QuestionnaireController::class, 'store'])->name('store');
});