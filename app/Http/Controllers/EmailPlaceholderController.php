<?php
/**
 * @created 08-02-2017
 * @author Hardeep
 */

namespace App\Http\Controllers;

use App\EmailPlaceholder;

class EmailPlaceholderController extends AppController
{    
    public $modelName = "EmailPlaceholder", $routePrefix = "email-placeholder";
    
    public $rules = array(
        'name' => ['required' => "required", "unique" => "unique:email_placeholders"],
    );
    
    /**
     * summary action
     * @return type
     */
    public function index()
    {
        $this->pageTitle = "Email Placeholders Summary";
        
        $where = $this->_getConditions([
            ["view_field" => "name", "type" => "string"],
        ]);
        
        if ($where)
        {
            $model = EmailPlaceholder::whereRaw($where);
        }
        else
        {
            $model = new EmailPlaceholder();
        }
        
        $summary = $model->sortable()->paginate($this->pagination["limit"]);
        
        return $this->view(null, compact("summary"));
    }
    
    /**
     * create action
     * @return type
     */
    public function create()
    {
        $this->pageTitle = "Email Placeholders Create";
        
        return $this->view(null);
    }
   
    /**
     * edit action
     * @param type $id
     * @return type
     */
    public function edit($id)
    {
        $this->pageTitle = "Email Placeholders Edit";
        
        $model = EmailPlaceholder::findOrFail($id);
        
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