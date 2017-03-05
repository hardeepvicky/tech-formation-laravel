<?php
namespace App;

class Permission extends AppModel 
{
    public $timestamps = false;
    
    protected $createdBy = false, $updatedBy = false, $deletedBy = false, $createdAt = false, $updatedAt = false;
    
    protected $fillable = ['name', 'type'];
    
    public function RolePermissions()
    {
        return $this->belongsToMany('App\Role', "role_permission", "permission_id", "role_id");
    }
}