<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\TicketController;

Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    Route::apiResource('raffle', RaffleController::class);
    Route::get('raffle/{raffle}/tickets', [RaffleController::class, 'tickets']);
    Route::get('raffle/{raffle}/card', [RaffleController::class, 'card']);
    Route::apiResource('participant', ParticipantController::class);
    Route::apiResource('ticket', TicketController::class);
});