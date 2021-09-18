<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SpaController extends Controller
{
    public function index ( Request $request )
    {
        $url_data = $request->all();

        return view(
            'index',

            [
                'url_data' => $url_data
            ]
        );
    }
}
