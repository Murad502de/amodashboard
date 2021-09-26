<?php

namespace App\Http\Controllers\Api;

use App\Models\Changingstages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ChangingstagesController extends Controller
{
    public function hook ( Request $request )
    {
        $inputData = $request->all();
        $modified_user_id = $inputData[ 'leads' ][ 'status' ][ 0 ][ 'modified_user_id' ];

        Log::info(
            __METHOD__,

            [
                'message' => $modified_user_id
            ]
        );

        Changingstages::create(
            [
                'modified_user_id' => $modified_user_id,
            ]
        );

        /*
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
        ];*/

        return response( [ 'OK' ], 200 );
    }

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
