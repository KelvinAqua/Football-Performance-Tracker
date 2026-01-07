<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\MatchPerformanceController;

// Home -> show teams list
Route::get('/', [TeamController::class, 'index'])->name('teams.index');

// Team routes
Route::get('/teams', [TeamController::class, 'index'])->name('teams.index');
Route::get('/teams/create', [TeamController::class, 'create'])->name('teams.create');
Route::post('/teams', [TeamController::class, 'store'])->name('teams.store');
Route::get('/teams/{id}', [TeamController::class, 'show'])->name('teams.show');
Route::delete('/teams/{id}', [TeamController::class, 'destroy'])->name('teams.destroy');


// Player routes
Route::get('/players', [PlayerController::class, 'index']);
Route::get('/players/create', [PlayerController::class, 'create']);
Route::post('/players', [PlayerController::class, 'store']);
Route::get('/players/{id}', [PlayerController::class, 'show']);

// Match performance route (add performance to a player)
Route::post('/players/{id}/performances', [MatchPerformanceController::class, 'store']);
