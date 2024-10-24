<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\TicketController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('raffle', RaffleController::class);
Route::get('raffle/{raffle}/tickets', [RaffleController::class, 'tickets']);
Route::get('raffle/{raffle}/card', [RaffleController::class, 'card']);
Route::apiResource('participant', ParticipantController::class);
Route::apiResource('ticket', TicketController::class);