<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\KeintasksController;
use App\Http\Controllers\Api\ActiveleadsController;

use App\Http\Controllers\Api\Services\amoAuthController;

Route::get( '/keintasks', [ KeintasksController::class, 'getChart' ] );
Route::get( '/activeleads', [ ActiveleadsController::class, 'getChart' ] );
Route::get( '/overduetasks', [ ActiveleadsController::class, 'handle' ] );
Route::get( '/changingstages', function () {
    return [
        'totalAmount' => 456,
        'leads' => [
            [ 'name' => 'User 1', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
            [ 'name' => 'User 2', 'count' => 13, 'percent' => 12, 'stage' => 4562584 ],
            [ 'name' => 'User 3', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
            [ 'name' => 'User 4', 'count' => 23, 'percent' => 34, 'stage' => 4562584 ],
            [ 'name' => 'User 5', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
            [ 'name' => 'User 6', 'count' => 23, 'percent' => 12, 'stage' => 4562584 ],
            [ 'name' => 'User 7', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
            [ 'name' => 'User 8', 'count' => 23, 'percent' => 34, 'stage' => 142 ],
            [ 'name' => 'User 9', 'count' => 23, 'percent' => 34, 'stage' => 143 ],
        ]
    ];
} );
Route::get( '/usagetime', function () {
    return [
        'totalAmount' => 456,
        'users' => [
            [ 'name' => 'user_1', 'count' => '1h 32m', 'percent' => 14 ],
            [ 'name' => 'user_2', 'count' => '1h 32m', 'percent' => 12 ],
            [ 'name' => 'user_3', 'count' => '1h 32m', 'percent' => 24 ],
            [ 'name' => 'user_4', 'count' => '1h 32m', 'percent' => 34 ],
            [ 'name' => 'user_5', 'count' => '1h 32m', 'percent' => 14 ],
            [ 'name' => 'user_6', 'count' => '1h 32m', 'percent' => 12 ],
            [ 'name' => 'user_7', 'count' => '1h 32m', 'percent' => 24 ],
            [ 'name' => 'user_8', 'count' => '1h 32m', 'percent' => 34 ],
            [ 'name' => 'user_9', 'count' => '1h 32m', 'percent' => 34 ],
        ]
    ];
} );

Route::get( '/auth', [ amoAuthController::class, 'auth' ] );

Route::get( '/cron/activeleads', [ ActiveleadsController::class, 'getList' ] );

Route::get( '/test', function () {
    return 'test api route';
} );