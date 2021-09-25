<?php

namespace App\Http\Controllers\Api\Services;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\amoAPI\amoCRM;
use App\Models\Account;

class amoAuthController extends Controller
{
    private $amo;
    private $authData;
    private $account;

    function __construct ()
    {
        $this->account = new Account();
    }

    public function auth ( Request $request )
    {
        $this->authData = [
            'client_id'     => $request->all()[ 'client_id' ],
            'client_secret' => config( 'services.amoCRM' )[ 'client_secret' ],
            'code'          => $request->all()[ 'code' ],
            'redirect_uri'  => config( 'services.amoCRM' )[ 'redirect_uri' ],
            'subdomain'     => config( 'services.amoCRM' )[ 'subdomain' ]
        ];

        $this->amo = new amoCRM( $this->authData );

        Log::info(
            __METHOD__,

            $this->authData
        );

        $response = $this->amo->auth();

        if ( $response[ 'code' ] >= 200 && $response[ 'code' ] < 204 )
        {
            $accountData = [
                'subdomain'     => $this->authData[ 'subdomain' ],
                'access_token'  => $response[ 'body' ][ 'access_token' ],
                'redirect_uri'  => $this->authData[ 'redirect_uri' ],
                'token_type'    => $response[ 'body' ][ 'token_type' ],
                'refresh_token' => $response[ 'body' ][ 'refresh_token' ],
                'when_expires'  => time() + ( int )$response[ 'body' ]['expires_in'] - 400
            ];

            $this->account->login( $accountData );
        }

        return response( [ 'OK' ], 200 );
    }
}
