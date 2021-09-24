<?php

namespace App\Http\Controllers\Api\Services;

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
        $this->authData = config( 'services.amoCRM' );

        $this->amo = new amoCRM( $this->authData );
        $this->account = new Account();
    }

    public function auth ()
    {
        echo 'amoAuthController@auth<br>';

        $response = $this->amo->auth();

        if ( $response[ 'code' ] >= 200 && $response[ 'code' ] < 204 )
        {
            echo 'auth data save<br>';
            echo $response[ 'code' ] . ' <br>';

            echo 'amoAuthController@auth : response<br>';
            echo '<pre>';
            print_r( $response );
            echo '</pre><br>';

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
