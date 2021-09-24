<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KeintasksController extends Controller
{
    public function handle ()
    {
        return [
            'totalAmount' => 456,
            'leads' => [
                [ 'name' => 'Ivan', 'count' => 23, 'percent' => 34 ],
                [ 'name' => 'Maxim', 'count' => 23, 'percent' => 12 ],
                [ 'name' => 'Murad', 'count' => 23, 'percent' => 24 ],
                [ 'name' => 'Maxim', 'count' => 23, 'percent' => 12 ],
                [ 'name' => 'Murad', 'count' => 23, 'percent' => 24 ],
                [ 'name' => 'Ivan', 'count' => 23, 'percent' => 14 ],
                [ 'name' => 'Maxim', 'count' => 23, 'percent' => 12 ],
                [ 'name' => 'Murad', 'count' => 23, 'percent' => 24 ],
            ]
        ];
    }
}
