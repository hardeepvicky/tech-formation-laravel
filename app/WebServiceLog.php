<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebServiceLog extends Model
{
    protected $fillable = [
        'type', 'request', 'response', 'status', "execution_time"
    ];
}
