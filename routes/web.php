<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchievementsController;
use App\Http\Controllers\BadgesController;

Route::get('/users/{user}/achievements', [
    AchievementsController::class,
    'index',
]);
Route::post('/badges', [BadgesController::class, 'store']);
Route::post('/achievements', [AchievementsController::class, 'store']);
