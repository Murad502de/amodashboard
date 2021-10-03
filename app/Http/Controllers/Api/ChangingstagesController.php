<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Models\Changingstages;
use App\Services\amoAPI\amoCRM;
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

        return response( [ 'OK' ], 200 );
    }

    public function getChart ()
    {
        $this->account = new Account();
        $this->authData = $this->account->getAuthData();
        $this->amo = new amoCRM( $this->authData );

        $userList = $this->amo->list( 'users' );
        $changingstagesLeads = [
            'totalAmount' => null,
            'users'       => []
        ];

        if ( \count( $userList ) )
        {
            //$changingstagesLeads[ 'totalAmount' ] = Changingstages::all()->count();

            for ( $userListIndex = 0; $userListIndex < \count( $userList ); $userListIndex++ )
            {
                $users = $userList[ $userListIndex ][ '_embedded' ][ 'users' ];

                for ( $userIndex = 0; $userIndex < \count( $users ); $userIndex++ )
                {
                    $userId = ( int ) $users[ $userIndex ][ 'id' ];
                    $userName = $users[ $userIndex ][ 'name' ];

                    //echo 'userId: ' . $userId . ' <br>';
                    //echo 'userName: ' . $userName . ' <br><br>';

                    $changingstagesCount = Changingstages::where( 'modified_user_id', $userId )
                                                            ->count();

                    if ( $changingstagesCount )
                    {
                        $percent = $changingstagesCount / $changingstagesLeads[ 'totalAmount' ] * 100;

                        $changingstagesLeads[ 'totalAmount' ] = $changingstagesCount;
                        $changingstagesLeads[ 'users' ][] = [
                            'name' => $userName,
                            'count' => $changingstagesCount,
                            'percent' => $percent
                        ];
                    }
                }
            }
        }

        /*echo 'ChangingstagesleadsController@getList : ChangingstagesLeads<br>';
        echo '<pre>';
        print_r( $ChangingstagesLeads );
        echo '</pre><br>';*/

        return $changingstagesLeads;
    }

    public function cleanDb ()
    {
        Changingstages::truncate();

        return response( [ 'OK' ], 200 );
    }
}
