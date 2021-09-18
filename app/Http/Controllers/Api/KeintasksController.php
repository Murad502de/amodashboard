<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeintasksController extends Controller
{
    public function handle ()
    {
        return [
            'pipelines' => [
                'totalAmount' => 456,
                'list' => [
                    7896542 => [
                        'name' => 'pipline_1',
                        'amount' => 50,
                        'show' => true,
                        'leads' => [
                            [ 'name' => 'Ivan', 'count' => 23, 'percent' => 14 ],
                            [ 'name' => 'Maxim', 'count' => 23, 'percent' => 12 ],
                            [ 'name' => 'Murad', 'count' => 23, 'percent' => 24 ],
                            [ 'name' => 'Vadim', 'count' => 23, 'percent' => 34 ],
                        ]
                    ],

                    4853651 => [
                        'name' => 'pipline_2',
                        'amount' => 43,
                        'show' => true,
                        'leads' => [
                            [ 'name' => 'Andrey', 'count' => 23, 'percent' => 22 ],
                            [ 'name' => 'Darya', 'count' => 23, 'percent' => 11 ],
                            [ 'name' => 'Bogdan', 'count' => 23, 'percent' => 10 ],
                            [ 'name' => 'Yuliya', 'count' => 23, 'percent' => 5 ],
                        ]
                    ],

                    1452368 => [
                        'name' => 'pipline_3',
                        'amount' => 70,
                        'show' => true,
                        'leads' => [
                            [ 'name' => 'Alex', 'count' => 23, 'percent' => 42 ],
                            [ 'name' => 'Wolf', 'count' => 23, 'percent' => 35 ],
                        ]
                    ],
                ]
            ]
        ];
    }
}
