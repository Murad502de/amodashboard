<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\amoAPI\amoCRM;
use App\Models\Account;
use App\Models\Leads;
use App\Http\Controllers\Controller;

class KeintasksController extends Controller
{
    private $amo;
    private $authData;
    private $account;

    function __construct () {}

    public function getChart ()
    {
        $this->account = new Account();
        $this->authData = $this->account->getAuthData();
        $this->amo = new amoCRM( $this->authData );

        $userList = $this->amo->list( 'users' );
        $activeLeads = [
            'totalAmount' => null,
            'leads'       => []
        ];

        if ( \count( $userList ) )
        {
            $activeLeads[ 'totalAmount' ] = Leads::where( 'status_id', '!=', 142 )
                                                    ->where( 'status_id', '!=', 143 )
                                                    ->where( 'closest_task_at', '=', null )
                                                    ->count();

            for ( $userListIndex = 0; $userListIndex < \count( $userList ); $userListIndex++ )
            {
                $users = $userList[ $userListIndex ][ '_embedded' ][ 'users' ];

                for ( $userIndex = 0; $userIndex < \count( $users ); $userIndex++ )
                {
                    $userId = ( int ) $users[ $userIndex ][ 'id' ];
                    $userName = $users[ $userIndex ][ 'name' ];

                    //echo 'userId: ' . $userId . ' <br>';
                    //echo 'userName: ' . $userName . ' <br><br>';

                    $leadCount = Leads::where( 'responsible_user_id', $userId )
                                        ->where( 'status_id', '!=', 142 )
                                        ->where( 'status_id', '!=', 143 )
                                        ->where( 'closest_task_at', '=', null )
                                        ->count();

                    if ( $leadCount )
                    {
                        $percent = $leadCount / $activeLeads[ 'totalAmount' ] * 100;
                        $activeLeads[ 'leads' ][] = [
                            'name' => $userName,
                            'count' => $leadCount,
                            'percent' => $percent
                        ];
                    }
                }
            }
        }

        /*echo 'ActiveleadsController@getList : activeLeads<br>';
        echo '<pre>';
        print_r( $activeLeads );
        echo '</pre><br>';*/

        return $activeLeads;
    }
}
