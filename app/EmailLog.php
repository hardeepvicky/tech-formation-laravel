<?php
namespace App;

class EmailLog extends AppModel 
{
    public $timestamps = false;
    protected $createdBy = false, $updatedBy = false, $deletedBy = false, $createdAt = true, $updatedAt = false, $deletedAt = false;
    
    protected $fillable = ['from_email', 'to_email', 'subject', 'body'];
    public $sortable = ['from_email', 'to_email'];
}