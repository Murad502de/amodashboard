<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Usagetime;
use App\Services\amoAPI\amoCRM;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class UsagetimeController extends Controller
{
    public function hook ( Request $request )
    {
        $inputData = $request->all();
        $userId = $inputData[ 'user_id' ];

        Log::info(
            __METHOD__,

            [
                'user ID' => $userId
            ]
        );

        $user = Usagetime::where( 'user_id', $userId )->first();

        if ( $user )
        {
            $lastUserUpdate = $user->updated_at->getTimestamp();

            Log::info(
                __METHOD__,

                [
                    'user' => 'ist gefunden',
                    'last_update' => $lastUserUpdate
                ]
            );

            if ( \time() - $lastUserUpdate > 60 )
            {
                Log::info(
                    __METHOD__,

                    [
                        'messsage' => 'user muss aktualisiert werden'
                    ]
                );
            }
            else
            {
                Log::info(
                    __METHOD__,

                    [
                        'messsage' => 'user kann nicht aktualisiert werden'
                    ]
                );
            }
        }
        else
        {
            Log::info(
                __METHOD__,

                [
                    'user' => 'ist nicht gefunden'
                ]
            );

            Usagetime::create(
                [
                    'user_id' => $userId,
                    'online' => 60,
                ]
            );
        }

        return response( [ 'OK' ], 200 );
    }

    public function cleanDb () {}

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
