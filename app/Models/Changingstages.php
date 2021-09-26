<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Changingstages extends Model
{
    use HasFactory;

    protected $fillable = [
        'modified_user_id'
    ];
}
