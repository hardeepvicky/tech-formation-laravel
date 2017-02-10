<?php
/**
 * @created 23-01-2017
 * @author Hardeep Singh
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Session;
use DateUtility;
use Validator;
use App\AppModel;
use Route;

class AppController extends Controller
{
    public $rules = [], $params = [];
    
    public $modelName = "", $routePrefix, $pageTitle = "Test-Laravel";
    
    public $pagination = array(
        "limit" => 10,
        "order" => array(
            "field" => "id",
            "dir" => "DESC"
        )
    );
    
    public function __construct()
    {
        //enable query log
        if (\Config::get('app.debug'))
        {
            \Illuminate\Support\Facades\DB::connection()->enableQueryLog();
        }
    }
    
    protected function view($view = null, $data = array())
    {
        $data["modelName"] = $this->modelName;
        
        $data["routePrefix"] = $this->routePrefix;
        
        list(, $action) = explode('@', Route::getCurrentRoute()->getActionName());
        
        $data["action"] = $action;
        
        $data["route"] = Route::current()->uri();
        
        if (!$view)
        {
            $view = $this->modelName . "." . $action;
        }
        
        $data["view"] = $view;
        
        $data['pageTitle'] = $this->pageTitle;
        
        if (!empty(AppModel::$authUser))
        {
            $data["authUser"] = AppModel::$authUser;
        }
        
        if (Session::has(ACL_KEY))
        {
            $data[ACL_KEY] = Session::get(ACL_KEY);
        }
        
        foreach($this->params as $k => $v)
        {
            $data[$k] = $v;
        }
        
        return view($view, $data);
    }
    
    /**
	 * Store a newly created resource in storage.
	 */
	public function store($route = NULL)
	{
        $validator = Validator::make(Input::all(), $this->rules);

        $modelClass = "App\\" . $this->modelName;
            
        $model = new $modelClass();
        
        $model->fill(Input::all());
        
        if ($validator->passes() && $model->save())
        {   
            if (!$route)
            {
                $route = $this->routePrefix;
            }
            
            return redirect($route)->withSuccess("Record saved successfully");
        }
        
        return back()->withFailure("Failed to save record")->withErrors($validator)->withInput(Input::all());
	}
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, $route = NULL)
    {
        $validator = Validator::make(Input::all(), $this->rules);

        $modelClass = "App\\" . $this->modelName;
            
        $model = $modelClass::findOrFail($id);
        
        $model->fill(Input::all());
        
        if ($validator->passes() && $model->save())
        {   
            if (!$route)
            {
                $route = $this->routePrefix;
            }
            
            return redirect($route)->withSuccess("Record updated successfully");
        }
        
        return back()->withFailure("Failed to update record")->withErrors($validator)->withInput(Input::all());
    }
        
    /**
     * delete
     * @param type $id
     * @return type
     */
    public function destroy($id, $route = NULL)
    {
        $modelClass = "App\\" . $this->modelName;
            
        if ($modelClass::destroy($id))
        {   
            if (!$route)
            {
                $route = $this->routePrefix;
            }
            
            return redirect($route)->withSuccess("Record deleted successfully");
        }
        
        return back()->withFailure("Failed to delete Record due to having associated data");
    }
    
    /**
     * action to change status
     * @param type $id
     * @param type $status
     * @return to previous url
     */
    public function toggle_active($id, $status)
    {
        $status = (int) !$status;
        
        $msg = $status ? "activate" : "de-activate";
        
        $modelClass = "App\\" . $this->modelName;
            
        $model = $modelClass::findOrFail($id);

        $model->setAttribute("is_active", $status);
        
        $model->save();
            
        if (request()->ajax())
        {
            return [
                "status" => $status
            ];
        }
        else
        {
            return back()->withSuccess("Record $msg successfully");
        }
    }
    
    /**
     * get conditions
     * @param array $data
     * @return array conditions
     */
    protected final function _getConditions($data)
    {
        $conditions = $search = [];
        
        $parameters = Input::all();
        
        foreach($data as $arr)
        {
            //set view field if view field not given
            $view_field = $arr["view_field"]; 
            
            $arr["field"] = isset($arr["field"]) ? $arr["field"] : $view_field;
            $arr["op"] = isset($arr["op"]) ? $arr["op"] : "=";
            $arr["type"] = isset($arr["type"]) ? $arr["type"] : "";
            
            //set empty search for view
            $search[$view_field] = "";
            
            if (!isset($parameters[$view_field]) || strlen($parameters[$view_field]) == 0)
            {
                continue;
            }
            
            $search[$view_field] = $parameters[$view_field];
                
            $value = trim($parameters[$view_field]);
            
            //creating condition depends upon its field type
            switch(strtolower($arr["type"]))
            {
                case "string" : 
                    $value = "%" . $value . "%";
                    $arr["op"] = "LIKE";
                    break;

                case "date":
                    $value = DateUtility::get($value);
            }
            
            if (is_array($arr["field"]))
            {
                $condition = [];
                foreach($arr["field"] as $f)
                {
                    $condition["OR"][] = [
                        "field" => $f,
                        "op" =>  $arr["op"], 
                        "value" => $value
                    ];
                }
            }
            else
            {
                $condition = [
                    "field" => $arr["field"],
                    "op" =>  $arr["op"], 
                    "value" => $value
                ];
            }
            
            $conditions["AND"][] = $condition;
        }
        
        $this->params["search"] = $search;
        
        return get_where($conditions);
    }
}