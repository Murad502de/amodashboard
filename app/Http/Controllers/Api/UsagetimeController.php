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

        Log::info( __METHOD__, [ 'user ID' => $userId ] );

        $user = Usagetime::where( 'user_id', $userId )->first();

        if ( $user )
        {
            $lastUserUpdate = $user->updated_at->getTimestamp();

            Log::info( __METHOD__, [ 'user' => 'ist gefunden', 'last_update' => $lastUserUpdate ] );

            if ( \time() - $lastUserUpdate >= 60 )
            {
                Log::info( __METHOD__, [ 'messsage' => 'user muss aktualisiert werden' ] );

                $user->online += 60;
                $user->save(); 
            }
            else
            {
                Log::info( __METHOD__, [ 'messsage' => 'user kann nicht aktualisiert werden' ] );
            }
        }
        else
        {
            Log::info( __METHOD__, [ 'user' => 'ist nicht gefunden' ] );

            Usagetime::create(
                [
                    'user_id' => $userId,
                    'online' => 60,
                ]
            );
        }

        return response( [ 'OK' ], 200 );
    }

    public function cleanDb ()
    {
        Usagetime::truncate();

        return response( [ 'OK' ], 200 );
    }

    public function getChart ()
    {
        $this->account = new Account();
        $this->authData = $this->account->getAuthData();
        $this->amo = new amoCRM( $this->authData );

        $userList = $this->amo->list( 'users' );
        $usagetimeUserList = [
            'totalAmount' => null,
            'users'       => []
        ];

        if ( \count( $userList ) )
        {
            $usagetimeUserList[ 'totalAmount' ] = Usagetime::all()->sum( 'online' );

            for ( $userListIndex = 0; $userListIndex < \count( $userList ); $userListIndex++ )
            {
                $users = $userList[ $userListIndex ][ '_embedded' ][ 'users' ];

                for ( $userIndex = 0; $userIndex < \count( $users ); $userIndex++ )
                {
                    $userId = ( int ) $users[ $userIndex ][ 'id' ];
                    $userName = $users[ $userIndex ][ 'name' ];

                    $currentUser = Usagetime::where( 'user_id', $userId )->first();

                    if ( $currentUser )
                    {
                        $online = $currentUser->online;
                        $percent = $online / $usagetimeUserList[ 'totalAmount' ] * 100;

                        $usagetimeUserList[ 'users' ][] = [
                            'name' => $userName,
                            'count' => $online,
                            'percent' => $percent
                        ];
                    }
                }
            }
        }

        echo 'UsagetimeController@getList : usagetimeUserList<br>';
        echo '<pre>';
        print_r( $usagetimeUserList );
        echo '</pre><br>';

        return $usagetimeUserList;
    }
}
