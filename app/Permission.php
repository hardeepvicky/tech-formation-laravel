<?php
namespace App;

class Permission extends AppModel 
{
    protected $fillable = ['name', 'type'];
    
    public function RolePermissions()
    {
        return $this->belongsToMany('App\Role', "role_permission", "permission_id", "role_id");
    }
}