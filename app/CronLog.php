<?php
namespace App;

class CronLog extends AppModel
{
    public $timestamps = false;
    protected $createdBy = false, $updatedBy = false, $deletedBy = false, $createdAt = true, $updatedAt = false, $deletedAt = false;
    
    protected $fillable = ['type', 'exception', 'status', "execution_time"];
    public $sortable = ['execution_time', 'status'];
}
