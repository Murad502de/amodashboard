<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\KeintasksController;
use App\Http\Controllers\Api\ActiveleadsController;

Route::get( '/keintasks', [ KeintasksController::class, 'handle' ] );
Route::get( '/activeleads', [ ActiveleadsController::class, 'handle' ]);