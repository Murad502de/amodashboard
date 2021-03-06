<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\KeintasksController;
use App\Http\Controllers\Api\ActiveleadsController;
use App\Http\Controllers\Api\OverduetasksController;
use App\Http\Controllers\Api\ChangingstagesController;
use App\Http\Controllers\Api\UsagetimeController;

use App\Http\Controllers\Api\Services\amoAuthController;

Route::get( '/auth', [ amoAuthController::class, 'auth' ] );

Route::middleware( [ 'amoAuth' ] )->group( function () {
    Route::get( '/keintasks', [ KeintasksController::class, 'getChart' ] );
    Route::get( '/activeleads', [ ActiveleadsController::class, 'getChart' ] );
    Route::get( '/overduetasks', [ OverduetasksController::class, 'getChart' ] );
    Route::get( '/changingstages', [ ChangingstagesController::class, 'getChart' ] );
    Route::get( '/usagetime', [ UsagetimeController::class, 'getChart' ] );

    Route::get( '/cron/activeleads', [ ActiveleadsController::class, 'getList' ] );
    Route::get( '/cron/overduetasks', [ OverduetasksController::class, 'getList' ] );
    Route::get( '/cron/changingstages', [ ChangingstagesController::class, 'cleanDb' ] );
    Route::get( '/cron/usagetime', [ UsagetimeController::class, 'cleanDb' ] );

    Route::post( '/hook/changingstages', [ ChangingstagesController::class, 'hook' ] );
    Route::post( '/hook/usagetime', [ UsagetimeController::class, 'hook' ] );
} );