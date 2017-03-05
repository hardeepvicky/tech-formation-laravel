<?php
/**
 * User Controller
 * 
 * @created 23-01-2017
 * @author Hardeep
 */

namespace App\Http\Controllers;

use App\WebServiceLog;
use App\CronLog;
use App\EmailLog;

class LogController extends AppController
{    
    public $modelName = "", $routePrefix = "log";

    /**
     * @return type
     */
    public function web_service()
    {
        $this->modelName = "WebServiceLog";
        
        $this->pageTitle = "Web Service Log Summary";
        
        $where = $this->_getConditions([
            ["view_field" => "type"],
            ["view_field" => "status"],
            ["view_field" => "from_date", "op" => ">", "field" => "created_at", "type" => "date"],
            ["view_field" => "to_date", "op" => "<", "field" => "created_at", "type" => "date"],
        ]);
        
        if ($where)
        {
            $model = WebServiceLog::whereRaw($where);            
        }
        else
        {
            $model = new WebServiceLog();
        }
        
        $summary = $model->sortable()->paginate($this->pagination["limit"]);
        
        $web_service_types = array(
            1 => "Login"
        );
        
        return $this->view('Log.web_service', compact("summary", "web_service_types"));
    }
    
    /**
     * @return type
     */
    public function cron()
    {
        $this->modelName = "CronLog";
        $this->pageTitle = "Cron Log Summary";
        
        $where = $this->_getConditions([
            ["view_field" => "type"],
            ["view_field" => "status"]
        ]);
        
        if ($where)
        {
            $model = CronLog::whereRaw($where);            
        }
        else
        {
            $model = new CronLog();
        }
        
        $summary = $model->orderBy($this->pagination["order"]["field"], $this->pagination["order"]["dir"])
            ->paginate($this->pagination["limit"]);
        
        $cron_types = [
            1 => "Email"
        ];
        
        return $this->view('Log.corn', compact("summary", "cron_types"));
    }
    
    /**
     * @return type
     */
    public function email_log()
    {
        $this->modelName = "EmailLog";
        $this->pageTitle = "Email Log Summary";
        
        $where = $this->_getConditions([
            ["view_field" => "email", 'type' => 'string', "field" => ['from_email', 'to_email', 'subject', 'body']],
            ["view_field" => "status"]
        ]);
        
        if ($where)
        {
            $model = EmailLog::whereRaw($where);            
        }
        else
        {
            $model = new EmailLog();
        }
        
        $summary = $model->sortable()->paginate($this->pagination["limit"]);
        
        return $this->view('Log.email_log', compact("summary"));
    }
}