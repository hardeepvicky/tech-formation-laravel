<?php
/**
 * @created 16-12-2016
 * @author Gagan
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use DB;
use App\WebServiceLog;
use Exception;

class WebServiceController extends Controller
{
    public $requestData, $response, $webServiceLog, $serviceType, $start_time;
    
    //type : quantity, fat, snf, amount, kgsnf, kgfat
    public $services = [
        "login" => [
            "from_date" => "",
            "type" => ""
        ],
    ];
    
    public $serviceTypes = array(
        "login" => 1,
    );
    
    /**
     * collectoon services
     */
    public function login()
    {
        $this->requestData = Input::all();
        $this->serviceType = $this->serviceTypes["login"];
        
        if (is_mobile())
        {
            $this->_log_save();
        }
        
        try
        {
            $this->_validateServiceRequest($this->services["login"], $this->requestData);

            //to do 
            //code for login
                
            $this->response["status"] = 1;
            $this->response["msg"] = "Success";
        } 
        catch (Exception $ex)
        {
            $this->response["status"] = 0;
            $this->response["msg"] = $ex->getMessage();
        }
        
        if (is_mobile())
        {
            $this->_log_update();
        }
            
        return $this->response;
    }
    
    /**
     * Web service log save
     */
    private function _log_save()
    {
        $this->start_time = microtime(true);

        header("Pragma: no-cache");
        header("Cache-Control: no-store, no-cache, max-age=0, must-revalidate");

        $json = json_encode($this->requestData);

        $this->webServiceLog = new WebServiceLog();
        
        $this->webServiceLog->fill([
            "type" => $this->serviceType,
            "request" => $json,
        ]);
        
        $this->webServiceLog->save();
                
        //setting default output
        $this->response = array(
            "msg" => "",
            "status" => 0,
            "data" => array()
        );
    }
    
    /**
     * Web service log update
     */
    private function _log_update()
    {
        $this->webServiceLog->response = json_encode($this->response);
        $this->webServiceLog->status = $this->response["status"];
        $this->webServiceLog->execution_time = round(microtime(true) - $this->start_time, 3);
        $this->webServiceLog->save(); 
    }
    
    /**
     * validating web service
     * @param type $match_data
     * @param type $data
     * @throws Exception
     */
    private function _validateServiceRequest($match_data, $data, $path = "")
    {
        foreach ($match_data as $field => $value)
        {
            if (!isset($data[$field]))
            {
                throw new Exception("Missing " . $path . $field);
            }

            if (!empty($value) && is_array($value))
            {
                $this->_validateServiceRequest($value, $data[$field], $path . $field . "->");
            }
        }
    }
}