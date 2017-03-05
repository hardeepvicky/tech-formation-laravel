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

class LogController extends AppController
{    
    public $modelName = "", $routePrefix = "log";

    /**
     * @return type
     */
    public function web_service()
    {
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
        
        return $this->view(null, compact("summary", "web_service_types"));
    }
    
    /**
     * @return type
     */
    public function cron()
    {
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
        
        return $this->view(null, compact("summary", "cron_types"));
    }
}