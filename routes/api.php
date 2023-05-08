<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlayerController;

Route::get('players', [PlayerController::class, 'index']);
Route::get('players/{id}', [PlayerController::class, 'show']);
Route::post('players', 'PlayerController@store');
Route::put('players/{id}', 'PlayerController@update');
Route::delete('players/{id}', 'PlayerController@delete');