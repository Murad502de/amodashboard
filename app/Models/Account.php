<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    //use HasFactory;

    protected $table;

    public function __construct ()
    {
        $this->table = 'amo_account';
    }

    public function login ( $accountData )
    {
        echo 'Account@login : accountData<br>';
        echo '<pre>';
        print_r( $accountData );
        echo '</pre><br>';

        self::truncate();

        $this->subdomain = $accountData[ 'subdomain' ];
        $this->access_token = $accountData[ 'access_token' ];
        $this->redirect_uri = $accountData[ 'redirect_uri' ];
        $this->token_type = $accountData[ 'token_type' ];
        $this->refresh_token = $accountData[ 'refresh_token' ];
        $this->when_expires = $accountData[ 'when_expires' ];

        $this->save();
    }
}
