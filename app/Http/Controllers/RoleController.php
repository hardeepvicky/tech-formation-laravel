<?php
/**
 * Role Controller
 * 
 * @created 23-01-2017
 * @author Hardeep
 */

namespace App\Http\Controllers;

use App\Role;

class RoleController extends AppController
{    
    public $modelName = "Role", $routePrefix = "role";
    
    public $rules = array(
        'name' => ['required' => "required", "unique" => "unique:roles"],
    );
    
    /**
     * summary action
     * @return type
     */
    public function index()
    {
        $this->pageTitle = "Role Summary";
        
        $where = $this->_getConditions([
            ["view_field" => "name", "type" => "string"],
        ]);
        
        if ($where)
        {
            $model = Role::whereRaw($where);
        }
        else
        {
            $model = new Role();
        }
        
        $summary = $model->orderBy($this->pagination["order"]["field"], $this->pagination["order"]["dir"])
            ->paginate($this->pagination["limit"]);
        
        return $this->view(null, compact("summary"));
    }
    
    /**
     * create action
     * @return type
     */
    public function create()
    {
        $this->pageTitle = "Role Create";
        
        return $this->view(null);
    }
   
    /**
     * edit action
     * @param type $id
     * @return type
     */
    public function edit($id)
    {
        $this->pageTitle = "Role Edit";
        
        $model = Role::findOrFail($id);
        
        return $this->view(null, compact("model"));
    }
    
    /**
     * update action
     * @param type $id
     * @param type $route
     * @return type
     */
    public function update($id, $route = NULL)
    {
        $this->rules["name"]["unique"] .= ",name,$id";
        
        return parent::update($id);
    }
}