<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\KeintasksController;
use App\Http\Controllers\Api\ActiveleadsController;

use App\Http\Controllers\Api\Services\amoAuthController;

Route::get( '/keintasks', [ KeintasksController::class, 'handle' ] );
Route::get( '/activeleads', [ ActiveleadsController::class, 'handle' ] );
Route::get( '/overduetasks', [ ActiveleadsController::class, 'handle' ] );
Route::get( '/changingstages', function () {
    return [
        'pipelines' => [
            'totalAmount' => 456,
            'list' => [
                7896542 => [
                    'name' => 'pipline_1',
                    'amount' => 50,
                    'show' => true,
                    'leads' => [
                        [ 'name' => 'первичный этап', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
                        [ 'name' => 'выявление потребностей', 'count' => 23, 'percent' => 12, 'stage' => 4562584 ],
                        [ 'name' => 'приянтие решения', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
                        [ 'name' => 'назначение встречи', 'count' => 23, 'percent' => 34, 'stage' => 4562584 ],
                        [ 'name' => 'проведение встречи', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
                        [ 'name' => 'заключение договора', 'count' => 23, 'percent' => 12, 'stage' => 4562584 ],
                        [ 'name' => 'ожидание оплаты', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
                        [ 'name' => 'успешно реализовано', 'count' => 23, 'percent' => 34, 'stage' => 142 ],
                        [ 'name' => 'закрыто и не реализовано', 'count' => 23, 'percent' => 34, 'stage' => 143 ],
                    ]
                ],

                4853651 => [
                    'name' => 'pipline_2',
                    'amount' => 43,
                    'show' => true,
                    'leads' => [
                        [ 'name' => 'первичный этап', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
                        [ 'name' => 'выявление потребностей', 'count' => 23, 'percent' => 12, 'stage' => 4562584 ],
                        [ 'name' => 'приянтие решения', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
                        [ 'name' => 'назначение встречи', 'count' => 23, 'percent' => 34, 'stage' => 4562584 ],
                        [ 'name' => 'проведение встречи', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
                        [ 'name' => 'заключение договора', 'count' => 23, 'percent' => 12, 'stage' => 4562584 ],
                        [ 'name' => 'ожидание оплаты', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
                        [ 'name' => 'успешно реализовано', 'count' => 23, 'percent' => 34, 'stage' => 142 ],
                        [ 'name' => 'закрыто и не реализовано', 'count' => 23, 'percent' => 34, 'stage' => 143 ],
                    ]
                ],

                1452368 => [
                    'name' => 'pipline_3',
                    'amount' => 70,
                    'show' => true,
                    'leads' => [
                        [ 'name' => 'первичный этап', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
                        [ 'name' => 'выявление потребностей', 'count' => 23, 'percent' => 12, 'stage' => 4562584 ],
                        [ 'name' => 'приянтие решения', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
                        [ 'name' => 'назначение встречи', 'count' => 23, 'percent' => 34, 'stage' => 4562584 ],
                        [ 'name' => 'проведение встречи', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
                        [ 'name' => 'заключение договора', 'count' => 23, 'percent' => 12, 'stage' => 4562584 ],
                        [ 'name' => 'ожидание оплаты', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
                        [ 'name' => 'успешно реализовано', 'count' => 23, 'percent' => 34, 'stage' => 142 ],
                        [ 'name' => 'закрыто и не реализовано', 'count' => 23, 'percent' => 34, 'stage' => 143 ],
                    ]
                ],
            ]
        ]
    ];
} );
Route::get( '/usagetime', function () {
    return [
        'pipelines' => [
            'totalAmount' => 456,
            'list' => [
                7896542 => [
                    'name' => 'group_1',
                    'time' => '12 h. 10 m.',
                    'amount' => 60,
                    'show' => true,
                    'users' => [
                        [ 'name' => 'user_1', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
                        [ 'name' => 'user_2', 'count' => 23, 'percent' => 12, 'stage' => 4562584 ],
                        [ 'name' => 'user_3', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
                        [ 'name' => 'user_4', 'count' => 23, 'percent' => 34, 'stage' => 4562584 ],
                        [ 'name' => 'user_5', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
                        [ 'name' => 'user_6', 'count' => 23, 'percent' => 12, 'stage' => 4562584 ],
                        [ 'name' => 'user_7', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
                        [ 'name' => 'user_8', 'count' => 23, 'percent' => 34, 'stage' => 142 ],
                        [ 'name' => 'user_9', 'count' => 23, 'percent' => 34, 'stage' => 143 ],
                    ]
                ],

                4853651 => [
                    'name' => 'group_2',
                    'time' => '12 h. 10 m.',
                    'amount' => 70,
                    'show' => true,
                    'users' => [
                        [ 'name' => 'user_1', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
                        [ 'name' => 'user_2', 'count' => 23, 'percent' => 12, 'stage' => 4562584 ],
                        [ 'name' => 'user_3', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
                        [ 'name' => 'user_4', 'count' => 23, 'percent' => 34, 'stage' => 4562584 ],
                        [ 'name' => 'user_5', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
                        [ 'name' => 'user_6', 'count' => 23, 'percent' => 12, 'stage' => 4562584 ],
                        [ 'name' => 'user_7', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
                        [ 'name' => 'user_8', 'count' => 23, 'percent' => 34, 'stage' => 142 ],
                        [ 'name' => 'user_9', 'count' => 23, 'percent' => 34, 'stage' => 143 ],
                    ]
                ],

                1452368 => [
                    'name' => 'group_3',
                    'time' => '12 h. 10 m.',
                    'amount' => 35,
                    'show' => true,
                    'users' => [
                        [ 'name' => 'user_1', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
                        [ 'name' => 'user_2', 'count' => 23, 'percent' => 12, 'stage' => 4562584 ],
                        [ 'name' => 'user_3', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
                        [ 'name' => 'user_4', 'count' => 23, 'percent' => 34, 'stage' => 4562584 ],
                        [ 'name' => 'user_5', 'count' => 23, 'percent' => 14, 'stage' => 4562584 ],
                        [ 'name' => 'user_6', 'count' => 23, 'percent' => 12, 'stage' => 4562584 ],
                        [ 'name' => 'user_7', 'count' => 23, 'percent' => 24, 'stage' => 4562584 ],
                        [ 'name' => 'user_8', 'count' => 23, 'percent' => 34, 'stage' => 142 ],
                        [ 'name' => 'user_9', 'count' => 23, 'percent' => 34, 'stage' => 143 ],
                    ]
                ],
            ]
        ]
    ];
} );

Route::get( '/auth', [ amoAuthController::class, 'auth' ] );