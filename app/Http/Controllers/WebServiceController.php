<?php
/**
 * @created 16-12-2016
 * @author Gagan
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use \Illuminate\Support\Facades\Auth;

use App\WebServiceLog;

use Exception;

class WebServiceController extends Controller
{
    public $requestData, $response, $webServiceLog, $serviceType, $start_time;
    
    //type : quantity, fat, snf, amount, kgsnf, kgfat
    public $services = [
        "login" => [
            "email" => "",
            "password" => ""
        ],
    ];
    
    public $serviceTypes = array(
        "login" => 1,
    );
    
    
    public function index()
    {
        $this->requestData = Input::all();
        $this->serviceType = $this->serviceTypes["login"];
        
        $this->_log_save();
        
        try
        {
            $this->_validateServiceType();
            
            $service = $this->requestData['service'];
            
            $this->_validateServiceRequest($this->services[$service], $this->requestData);

            $this->response["data"] = $this->{$service}();
                
            $this->response["status"] = 1;
            $this->response["msg"] = "Success";
        } 
        catch (Exception $ex)
        {
            $this->response["status"] = 0;
            $this->response["msg"] = $ex->getMessage();
        }
        
        $this->_log_update();
        
        return $this->response;
    }
    
    /**
     * collectoon services
     */
    public function login()
    {
        $data = [
            'email' => $this->requestData['email'],
            'password' => $this->requestData['password'],
            'is_active' =>  1,
        ];
        
        if (Auth::attempt($data, true))
        {
            $user = Auth::user();
            
            return [
                "role_id" =>  $user['role_id'],
                "first_name" =>  $user['first_name'],
                "last_name" =>  $user['last_name'],
                "email" =>  $user['email'],
                "remember_token" =>  $user['remember_token'],
            ];
        }
        else
        {
            throw new Exception ("Invalid username and password. User may be deactived");
        }
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
            "request" => $json
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
    
    private function _validateServiceType()
    {
        if (!isset($this->requestData['service']))
        {
            throw new Exception("Missing Service");
        }
        
        if (!isset($this->serviceTypes[$this->requestData['service']]))
        {
            throw new Exception("Invaild Service");
        }
        
        $this->serviceType = $this->serviceTypes[$this->requestData['service']];
        
        $this->webServiceLog->type = $this->serviceType;
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