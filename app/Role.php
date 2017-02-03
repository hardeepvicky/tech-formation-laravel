<?php
namespace App;

use Permission;

class Role extends AppModel 
{
    protected $fillable = ['name'];
    
    public function RolePermissions()
    {
        return $this->belongsToMany(Permission::class, "role_permission", "role_id", "permission_id");
    }
}