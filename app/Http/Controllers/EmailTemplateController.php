<?php
/**
 * Role Controller
 * 
 * @created 23-01-2017
 * @author Hardeep
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use App\EmailTemplate;
use App\EmailPlaceholder;

class EmailTemplateController extends AppController
{    
    public $modelName = "EmailTemplate", $routePrefix = "email-template";
    
    public $rules = array(
        'code' => ['required' => "required", "unique" => "unique:email_templates"],
        'subject' => ['required' => "required"],
        'body' => ['required' => "required"],
        'placeholder_ids' => ['required' => "required"],
    );
    
    /**
     * summary action
     * @return type
     */
    public function index()
    {
        $this->pageTitle = "Email Template Summary";
        
        $where = $this->_getConditions([
            ["view_field" => "code", "type" => "string"],
        ]);
        
        if ($where)
        {
            $model = EmailTemplate::whereRaw($where);
        }
        else
        {
            $model = new EmailTemplate();
        }
        
        $summary = $model->sortable()->paginate($this->pagination["limit"]);
        
        $this->_setList();
        
        return $this->view(null, compact("summary"));
    }
    
    /**
     * create action
     * @return type
     */
    public function create()
    {
        $this->pageTitle = "Email Template Create";
        
        $this->_setList();
        
        return $this->view(null);
    }
    
    public function store($route = NULL)
	{
        Input::merge(['placeholder_ids' => implode(",", input::get("placeholder_ids")) ]);
        return parent::store();
    }
   
    /**
     * edit action
     * @param type $id
     * @return type
     */
    public function edit($id)
    {
        $this->pageTitle = "Email Template Edit";
        
        $model = EmailTemplate::findOrFail($id);
        
        $this->_setList();
        
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
        Input::merge(['placeholder_ids' => implode(",", input::get("placeholder_ids")) ]);
        
        $this->rules["code"]["unique"] .= ",code,$id";
        
        return parent::update($id);
    }
    
    public function test_send_email()
    {
        $email = EmailTemplate::findOrFail(2);
        
        $email = $email->toArray();
        
        $email['placeholder_ids'] = explode(",", $email['placeholder_ids']);
        
        $placeholder_list = EmailPlaceholder::whereIn('id', $email['placeholder_ids'])->pluck("name", "id")->toArray();
        
        $placeholders['User.name'] = "Hardeep";
        $placeholders['User.email'] = "hardeepvicky1@gmail.com";
        $placeholders['User.password'] = "1245678";
        
        if ($email["placeholder_ids"])
        {
            foreach($email['placeholder_ids'] as $id)
            {
                if (isset($placeholder_list[$id]))
                {
                    $placeholder = $placeholder_list[$id];

                    $email['body'] = str_replace("[" . $placeholder . "]", $placeholders[$placeholder], $email['body']);
                    $email['subject'] = str_replace("[" . $placeholder . "]", $placeholders[$placeholder], $email['subject']);
                }
            }
        }
        
        $this->email(['email' => "hardeepvicky1@gmail.com", 'name' => "Hardeep Singh"], ['email' => "hardeep.singh417@gmail.com", 'name' => "Hardeep Singh"], $email['subject'], $email['body']);
        
        echo "done";  exit;
    }
    
    private function _setList()
    {
        $this->params['placeholder_list'] = EmailPlaceholder::orderBy('name', 'ASC')->pluck("name", "id")->toArray();
    }
}