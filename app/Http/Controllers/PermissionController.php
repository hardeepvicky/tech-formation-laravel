<?php
/**
 * @created 23-01-2017
 * @author Hardeep
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\Permission;
use App\Role;
use App\RolePermission;

class PermissionController extends AppController
{    
    public $modelName = "Permission", $routePrefix = "permission";
    
    public $rules = array(
        'name' => ['required']
    );
    
    /**
     * summary action
     * @return type
     */
    public function index()
    {
        $this->pageTitle = "Permissions";
        
        $this->params['role_list'] = Role::orderBy('id', 'ASC')->pluck("name", "id")->toArray();
        $permissions = Permission::get()->toArray();
        
        $temp = RolePermission::get()->toArray();
        
        $role_permissions = [];
        
        foreach($temp as $arr)
        {
            $role_permissions[$arr["role_id"]][$arr["permission_id"]] = "1";
        }
        
        return $this->view(null, compact("role_permissions", "permissions"));
    }
    
    /**
     * @return type
     */
    public function refresh($delete_all = 0)
    {
        $data = $this->_getRouteList();
        
        $id_list = [];
        
        foreach($data as $arr)
        {
            $id_list[] = "'" . $arr["name"] . "'";
        }
        
        if ($delete_all)
        {
            Permission::query()->truncate();
            RolePermission::query()->truncate();
        }
        else
        {
            $ids_to_delete = Permission::whereRaw("name NOT IN (" . implode(",", $id_list) . ")")->pluck("id", "id")->toArray();

            if ($ids_to_delete)
            {
                Permission::destroy($ids_to_delete);
            }
        }
        
        
        $db_route_list = Permission::pluck("id", "name")->toArray();
        
        foreach($data as $k => $arr)
        {
            if (isset($db_route_list[$arr['name']]))
            {
                unset($data[$k]);
            }
        }
        
        Permission::insert($data);
        
        return redirect($this->routePrefix);
    }
    
    public function store($route = NULL)
    {
        $data = [];
        
        foreach(Input::all()["data"] as $role_id => $permissions)
        {
            foreach($permissions as $per_id => $v)
            {
                $data[] = [
                    "role_id" => $role_id,
                    "permission_id" => $per_id
                ];
            }
        }
        
        RolePermission::query()->truncate();
        
        RolePermission::insert($data);
        
        return redirect($this->routePrefix)->withSuccess("Record saved successfully");
    }
   
    private function _getRouteList()
    {
        $list = [];
        $routes = \Route::getRoutes();
        
        foreach($routes as $route)
        {
            $arr = $route->getMethods();
            
            foreach($arr as $type)
            {
                if ($type == "HEAD")
                {
                    continue;
                }
                
                $list[] = array(
                    "name" => $route->getPath(),
                    "type" => $type
                );
            }
        }
        
        return $list;
    }
}