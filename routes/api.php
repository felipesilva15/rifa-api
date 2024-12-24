<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UtilsController;

// Auth
Route::post('/login', [AuthController::class, 'login']);

// Utils
Route::post('/utils/generate-hash', [UtilsController::class, 'generateHash']);
Route::get('/utils/generate-hash', [UtilsController::class, 'generateHash']);

// Raffle
Route::get('raffle/{raffle}/card', [RaffleController::class, 'card']);
Route::get('raffle/{id}', [RaffleController::class, 'show']);

Route::group(['middleware' => 'auth:api'], function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh-token', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);

    // Raffle
    Route::apiResource('raffle', RaffleController::class);
    Route::get('raffle/{raffle}/tickets', [RaffleController::class, 'tickets']);

    // Participant
    Route::apiResource('participant', ParticipantController::class);
    
    // Ticket
    Route::apiResource('ticket', TicketController::class);
});