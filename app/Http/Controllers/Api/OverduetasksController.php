<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\amoAPI\amoCRM;
use App\Models\Account;
use App\Models\Tasks;
use App\Http\Controllers\Controller;

class OverduetasksController extends Controller
{
    private $amo;
    private $authData;
    private $account;

    function __construct()
    {
        $this->account = new Account();
        $this->authData = $this->account->getAuthData();
        $this->amo = new amoCRM( $this->authData );
    }

    public function getList ()
    {
        $taskList = $this->amo->listByQuery( 'task', 'filter[is_completed]' );

        if ( \count( $taskList ) )
        {
            Tasks::truncate();

            for ( $taskListIndex = 0; $taskListIndex < \count( $taskList ); $taskListIndex++ )
            {
                $tasks = $taskList[ $taskListIndex ][ '_embedded' ][ 'tasks' ];

                for ( $taskIndex = 0; $taskIndex < \count( $tasks ); $taskIndex++ )
                {
                    $responsible_user_id = $tasks[ $taskIndex ][ 'responsible_user_id' ];
                    $is_completed        = $tasks[ $taskIndex ][ 'is_completed' ];
                    $complete_till       = $tasks[ $taskIndex ][ 'complete_till' ];

                    Tasks::create(
                        [
                            'responsible_user_id' => $responsible_user_id,
                            'is_completed'        => $is_completed,
                            'complete_till'       => $complete_till
                        ]
                    );

                    /*echo $taskListIndex . ' <br>';
                    echo 'responsible_user_id: ' . $responsible_user_id . '<br>';
                    echo 'is_completed: ' . $is_completed . '<br>';
                    echo 'complete_till: ' . $complete_till . '<br>';
                    echo 'closest_task_at: ' . $closest_task_at . '<br>';
                    echo '<br>';*/
                }
            }
        }

        echo 'ActiveleadsController@getList : taskList<br>';
        echo '<pre>';
        print_r( $taskList );
        echo '</pre><br>';
    }

    public function getChart ()
    {
        $userList = $this->amo->list( 'users' );
        $activeLeads = [
            'totalAmount' => null,
            'leads'       => []
        ];

        if ( \count( $userList ) )
        {
            $activeLeads[ 'totalAmount' ] = Tasks::all()->count();

            for ( $userListIndex = 0; $userListIndex < \count( $userList ); $userListIndex++ )
            {
                $users = $userList[ $userListIndex ][ '_embedded' ][ 'users' ];

                for ( $userIndex = 0; $userIndex < \count( $users ); $userIndex++ )
                {
                    $userId = ( int ) $users[ $userIndex ][ 'id' ];
                    $userName = $users[ $userIndex ][ 'name' ];

                    //echo 'userId: ' . $userId . ' <br>';
                    //echo 'userName: ' . $userName . ' <br><br>';

                    $leadCount = Tasks::where( 'responsible_user_id', $userId )->where( 'status_id', '!=', 142 )->where( 'status_id', '!=', 143 )->count();

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
