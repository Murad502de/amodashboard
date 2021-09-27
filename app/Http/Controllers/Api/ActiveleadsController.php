<?php

namespace App\Http\Controllers\Api;

use App\Models\Leads;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Services\amoAPI\amoCRM;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class ActiveleadsController extends Controller
{
    private $amo;
    private $authData;
    private $account;

    function __construct() {}

    public function getList ()
    {
        Log::info(
            __METHOD__,

            [
                'message'  => 'cron was launched'
            ]
        );

        $this->account = new Account();
        $this->authData = $this->account->getAuthData();
        $this->amo = new amoCRM( $this->authData );

        $leadList = $this->amo->list( 'lead' );

        if ( \count( $leadList ) )
        {
            Leads::truncate();

            for ( $leadListIndex = 0; $leadListIndex < \count( $leadList ); $leadListIndex++ )
            {
                $leads = $leadList[ $leadListIndex ][ '_embedded' ][ 'leads' ];

                for ( $leadIndex = 0; $leadIndex < \count( $leads ); $leadIndex++ )
                {
                    $responsible_user_id = $leads[ $leadIndex ][ 'responsible_user_id' ];
                    $status_id = $leads[ $leadIndex ][ 'status_id' ];
                    $pipeline_id = $leads[ $leadIndex ][ 'pipeline_id' ];
                    $closest_task_at = $leads[ $leadIndex ][ 'closest_task_at' ];

                    Leads::create(
                        [
                            'responsible_user_id' => $responsible_user_id,
                            'status_id'           => $status_id,
                            'pipeline_id'         => $pipeline_id,
                            'closest_task_at'     => $closest_task_at
                        ]
                    );
                }
            }
        }
    }

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
            $activeLeads[ 'totalAmount' ] = Leads::all()->count();

            for ( $userListIndex = 0; $userListIndex < \count( $userList ); $userListIndex++ )
            {
                $users = $userList[ $userListIndex ][ '_embedded' ][ 'users' ];

                for ( $userIndex = 0; $userIndex < \count( $users ); $userIndex++ )
                {
                    $userId = ( int ) $users[ $userIndex ][ 'id' ];
                    $userName = $users[ $userIndex ][ 'name' ];

                    $leadCount = Leads::where( 'responsible_user_id', $userId )
                                        ->where( 'status_id', '!=', 142 )
                                        ->where( 'status_id', '!=', 143 )
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

        return $activeLeads;
    }
}
