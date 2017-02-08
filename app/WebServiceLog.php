<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebServiceLog extends Model
{
    use \Kyslik\ColumnSortable\Sortable;
    
    public $sortable = ['execution_time'];
    
    protected $fillable = [
        'type', 'request', 'response', 'status', "execution_time"
    ];
}
