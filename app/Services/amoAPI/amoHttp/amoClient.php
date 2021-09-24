<?php

namespace App\Services\amoAPI\amoHttp;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;

class amoClient
{
    private $client;
    private $errors = [
        400 => 'Bad request',
        401 => 'Unauthorized',
        403 => 'Forbidden',
        404 => 'Not found',
        500 => 'Internal server error',
        502 => 'Bad gateway',
        503 => 'Service unavailable',
    ];

    function __construct()
    {
        $this->client = new Client();
    }

    public function sendRequest( $requestData = null )
    {
        if ( !$requestData ) return;

        echo 'amoClient@sendRequest : requestData<br>';
        echo '<pre>';
        print_r( $requestData );
        echo '</pre><br>';

        try
        {
            $response = $this->client->request(
                $requestData[ 'method' ],
                $requestData[ 'url' ],
                [
                    'headers' => $requestData[ 'headers' ],
                    'json'    => $requestData[ 'data' ] ?? null,
                    'query' => $requestData[ 'query' ] ?? null,
                ]
            );

            return [
                'body' => json_decode( $response->getBody(), true ),
                'code' => $response->getStatusCode()
            ];
        }
        catch( \Exception $e )
        {
            Log::error(
                "amoAPI << [ sendRequest ] : Error while sending request\r\n" .
                "error code: " . $e->getCode() . "\r\n" .
                "error message: " . $e->getMessage() . "\r\n" .
                "request link: " . $requestData[ 'url' ] . "\r\n" .
                "request data: " . \print_r( $requestData, true ) . "\r\n" //.
                //"request response: " . \print_r( $response->getBody(), true ) . "\r\n"
            );

            return [
                'code' => ( int ) $e->getCode()
            ];
        }
    }

    // FIXME
    public function accessTokenVerification( $ServerAnfrageDaten )
    {
        if ( time() >= (int)$ServerAnfrageDaten[ 'when_expires' ] )
        {
            //echo "token ist verlauf\r\n";
            return $this->accessTokenUpdate( $ServerAnfrageDaten );
        }

        return $ServerAnfrageDaten;
    }

    /* =================================PUBLIC==METHODS================================= */

    public function accessTokenUpdate( $ServerAnfrageDaten )
    {
        //Формируем URL для запроса
        $this->link = 'https://' . $ServerAnfrageDaten[ 'subdomain' ] . '.amocrm.ru/oauth2/access_token';

        //Формируем Httpheaders для запроса
        $this->Httpheaders = [
            'Content-Type:application/json'
        ];

        /** Соберем данные для запроса */
        $data = [
            'client_id' => $ServerAnfrageDaten[ 'client_id' ],
            'client_secret' => $ServerAnfrageDaten[ 'client_secret' ],
            'grant_type' => 'refresh_token',
            'refresh_token' => $ServerAnfrageDaten[ 'refresh_token' ],
            'redirect_uri' => $ServerAnfrageDaten[ 'redirect_uri' ],
        ];
        
        $response = $this->sendRequest( $data );

        return $response;

        /*echo '<pre>'; print_r( $data ); echo '</pre>';
        echo '<br>';
        echo $this->link . '<br>';
        return true;*/
    }
}