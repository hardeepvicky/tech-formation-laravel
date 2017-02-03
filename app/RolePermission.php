<?php
namespace App;

class RolePermission extends AppModel 
{
    protected $fillable = ['name'];
    
    public function Permission()
    {
        return $this->belongsTo("App\Permission", "permission_id");
    }
    
    public function Role()
    {
        return $this->belongsTo("App\Role", "role_id");
    }
}