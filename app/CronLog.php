<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CronLog extends Model
{
    protected $fillable = [
        'type', 'exception', 'status', "execution_time"
    ];
}
