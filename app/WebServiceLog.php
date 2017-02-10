<?php
namespace App;

class WebServiceLog extends AppModel
{
    public $timestamps = false;
    
    protected $createdBy = false, $updatedBy = false, $deletedBy = false, $createdAt = true, $updatedAt = false, $deletedAt = false;
    
    public $sortable = ['execution_time'];
    
    protected $fillable = [
        'type', 'request', 'response', 'status', "execution_time"
    ];
}
