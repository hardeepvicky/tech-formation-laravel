<?php
namespace App;

class EmailTemplate extends AppModel 
{
    public $timestamps = false;
    
    protected $createdBy = true, $updatedBy = true, $deletedBy = false, $createdAt = true, $updatedAt = true;
    
    protected $fillable = ['code', 'subject', 'body', 'placeholder_ids'];
    public $sortable = ['code'];
}