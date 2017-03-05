<?php
namespace App;

use Permission;

class Role extends AppModel 
{
    public $timestamps = false;
    
    protected $createdBy = true, $updatedBy = true, $deletedBy = false, $createdAt = true, $updatedAt = true;
    
    protected $fillable = ['name'];
    
    public $sortable = ['name'];
    
    public function RolePermissions()
    {
        return $this->belongsToMany(Permission::class, "role_permission", "role_id", "permission_id");
    }
}