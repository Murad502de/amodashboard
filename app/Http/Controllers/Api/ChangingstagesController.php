<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangingstagesController extends Controller
{
    public function getChart () {
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
    }
}
