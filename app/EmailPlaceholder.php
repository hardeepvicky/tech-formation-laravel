<?php
namespace App;

class EmailPlaceholder extends AppModel 
{
    public $timestamps = false;
    
    protected $createdBy = false, $updatedBy = false, $deletedBy = false, $createdAt = false, $updatedAt = false;
    
    protected $fillable = ['name'];
    
    public $sortable = ['name'];
}