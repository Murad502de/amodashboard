<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsagetimeController extends Controller
{
    public function getChart ()
    {
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
    }
}
