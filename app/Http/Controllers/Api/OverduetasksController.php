<?php

namespace App\Http\Controllers\Api;

use App\Models\Tasks;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Services\amoAPI\amoCRM;
use Illuminate\Support\Facades\Log;
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

        echo 'OverduetasksController@getList : taskList<br>';
        echo '<pre>';
        print_r( $taskList );
        echo '</pre><br>';
    }

    public function getChart ()
    {
        Log::info(
            __METHOD__,

            [
                'message'  => 'cron was launched'
            ]
        );

        $userList = $this->amo->list( 'users' );
        $overdueTasks = [
            'totalAmount' => null,
            'tasks'       => []
        ];

        if ( \count( $userList ) )
        {
            $overdueTasks[ 'totalAmount' ] = Tasks::all()->count();

            for ( $userListIndex = 0; $userListIndex < \count( $userList ); $userListIndex++ )
            {
                $users = $userList[ $userListIndex ][ '_embedded' ][ 'users' ];

                for ( $userIndex = 0; $userIndex < \count( $users ); $userIndex++ )
                {
                    $userId = ( int ) $users[ $userIndex ][ 'id' ];
                    $userName = $users[ $userIndex ][ 'name' ];

                    //echo 'userId: ' . $userId . ' <br>';
                    //echo 'userName: ' . $userName . ' <br><br>';

                    $overdueTasksCount = Tasks::where( 'responsible_user_id', $userId )
                                                ->where( 'is_completed', 0 )
                                                ->where( 'complete_till', '<', \time() )
                                                ->count();

                    if ( $overdueTasksCount )
                    {
                        $percent = $overdueTasksCount / $overdueTasks[ 'totalAmount' ] * 100;

                        $overdueTasks[ 'tasks' ][] = [
                            'name' => $userName,
                            'count' => $overdueTasksCount,
                            'percent' => $percent
                        ];
                    }
                }
            }
        }

        /*echo 'OverduetasksController@getList : overdueTasks<br>';
        echo '<pre>';
        print_r( $overdueTasks );
        echo '</pre><br>';*/

        return $overdueTasks;
    }
}
