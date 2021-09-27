<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usagetime extends Model
{
    use HasFactory;

    protected $table = 'usagetime';
    protected $fillable = [
        'user_id',
        'online'
    ];
}
