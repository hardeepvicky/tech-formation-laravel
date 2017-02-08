<?php
/**
 * User Controller
 * 
 * @created 23-01-2017
 * @author Hardeep
 */

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\User;
use App\Role;
use App\RolePermission;
use Session;

class UserController extends AppController
{    
    public $modelName = "User", $routePrefix = "user";
    
    public $rules = array(
        'role_id' => ['required'],
        'first_name' => ['required'],
        'email' => ['required' => "required", "unique" => "unique:users"],
    );
    
    public $password_field_rules = array(
        "password" => "required | confirmed | min:5",
        "password_confirmation" => "required",
    );
    
    /**
     * summary action
     * @return type
     */
    public function index()
    {
        $this->pageTitle = "User Summary";
        
        $where = $this->_getConditions([
            ["view_field" => "name", "type" => "string", "field" => ["first_name", "last_name", "email"]],
            ["view_field" => "role_id"],
        ]);
        
        if ($where)
        {
            $model = User::whereRaw($where);            
        }
        else
        {
            $model = new User();
        }
        
        $summary = $model->sortable()->paginate($this->pagination["limit"]);
        
        $this->_setRoleList();
        
        return $this->view(null, compact("summary"));
    }
    
    /**
     * create action
     * @return type
     */
    public function create()
    {
        $this->pageTitle = "User Create";
        
        $this->_setRoleList();
        
        return $this->view(null);
    }
    
    /**
     * store action
     * @param type $route
     * @return type
     */
    public function store($route = NULL)
    {
        $this->rules = array_merge($this->rules, $this->password_field_rules);
        
        return parent::store($route);
    }
    
    /**
     * edit action
     * @param type $id
     * @return type
     */
    public function edit($id)
    {
        $model = User::findOrFail($id);
        
        $this->pageTitle = "User Edit";
        
        $this->_setRoleList();
        
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
        $this->rules["email"]["unique"] .= ",email,$id";
            
        return parent::update($id, $route);
    }
    
    /**
     * login action
     * @return view
     */
    public function login()
    {
        $this->layout = "login";
        
        if (Auth::check())
        {
            return redirect("user");
        }
        
        return $this->view();
    }
    
    /**
     * login post action
     * @return to previous url
     */
    public function login_attempt()
    {
        $data = Input::all();
        $data["is_active"] = 1;
        
        unset($data["_token"]);

        if (Auth::attempt($data, true))
        {
            $user = Auth::user();
            
            $permissions = RolePermission::with('Permission')->where("role_id", $user->role_id)->get()->toArray();
            
            $list = [];
            foreach($permissions as $record)
            {
                $list[$record["Permission"]["type"]][] = $record["Permission"]["name"];
            }
            
            if ($list)
            {
                Session::put(ACL_KEY, $list);
            }
            
            return back()->withSuccess("Welcome");
        }
        else
        {
            return back()->withFailure("Invalid Username or Password");
        }
    }
    
    /**
     * logout action
     * @return to login action
     */
    public function logout()
    {
        Auth::logout();
        
        return redirect("login");
    }
    
    /**
     * change password action
     * @return view
     */
    public function change_password()
    {
        $this->pageTitle = "Change Password";
         
        return $this->view();
    }
    
    /**
     * change password put action
     * @return to previous url
     */
    public function update_password()
    {
        $model = User::findOrFail(Auth::id());
        
        $rules = [
            "old_password" => "required",
            "password" => "required | confirmed | min:5",
            "password_confirmation" => "required",
        ];
        
        $input = Input::all();
        
        $validator = Validator::make(Input::all(), $rules);
        
        if (!Hash::check(trim($input["old_password"]), $model->password))
        {
            $validator->errors()->add('old_password', 'Wrong Password');
        }

        if (trim($input["password"]) == trim($input["old_password"]))
        {
            $validator->errors()->add('password', "Don't enter password used earlier");
        }

        $model->fill($input);
        
        if ($validator->passes() && $model->save())
        {
            return back()->withSuccess('Password changed successfully');
        }
        else
        {
            return back()->withFailure("Failed to change password")->withErrors($validator)->withInput($input);
        }
    }
    
    private function _setRoleList()
    {
        $this->params['role_list'] = Role::pluck("name", "id")->toArray();
    }
}