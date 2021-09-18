<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActiveleadsController extends Controller
{
    public function handle()
    {
        return [
            [ 'name' => 'Ivan', 'count' => 23, 'percent' => 14 ],
            [ 'name' => 'Maxim', 'count' => 23, 'percent' => 12 ],
            [ 'name' => 'Murad', 'count' => 23, 'percent' => 24 ]
        ];
    }
}
