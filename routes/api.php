<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuestionnaireController;

// Public routes
// Questionnaire routes
Route::prefix('questionnaire')->group(function () {
    Route::get('/', [QuestionnaireController::class, 'index']);
    Route::get('/{slug}', [QuestionnaireController::class, 'show']);
    Route::post('/{slug}/submit', [QuestionnaireController::class, 'store']);
});