<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\PlayerPricesController;
use App\Http\Controllers\MarketSettingsController;
use App\Http\Controllers\MarketAuctionController;
use App\Http\Controllers\MarketSaleController;
use App\Http\Controllers\TransfersController;
use App\Http\Controllers\UserController;

Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users', [UserController::class, 'store']);
Route::put('users/{id}', [UserController::class, 'update']);
Route::post('users/login', [UserController::class, 'login']);



Route::get('players', [PlayerController::class, 'index']);
Route::get('players/{id}', [PlayerController::class, 'show']);

/* Future use
Route::post('players', 'PlayerController@store');
Route::put('players/{id}', 'PlayerController@update');
Route::delete('players/{id}', 'PlayerController@delete');
*/


Route::get('prices', [PlayerPricesController::class, 'index']);

Route::get('market', [MarketSettingsController::class, 'index']);


Route::get('auction', [MarketAuctionController::class, 'index']);
Route::post('auction', [MarketAuctionController::class, 'store']);

Route::post('sale', [MarketSaleController::class, 'store']);

Route::get('transfers', [TransfersController::class, 'index']);



