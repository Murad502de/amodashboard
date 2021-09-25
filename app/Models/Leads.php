<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    use HasFactory;

    protected $fillable = [
        'responsible_user_id',
        'status_id',
        'pipeline_id',
        'closest_task_at',
    ];
}
