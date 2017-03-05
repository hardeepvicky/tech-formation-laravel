<?php

function debug($data)
{
    $bt = debug_backtrace();
    $caller = array_shift($bt);
    
    echo "<pre>";
    echo "<b>" . $caller["file"] . " : " . $caller["line"] . "</b><br/>";
    print_r($data);
    echo "</pre>";
}

function memory_used() 
{
    if (!defined ('LARAVEL_INITIAL_MEMORY'))
    {
        return 0;
    }
    
    $mem = round((memory_get_peak_usage() - LARAVEL_INITIAL_MEMORY)/1024);
    
    if ($mem > 1024)
    {
        $mem = round($mem / 1024, 2);
        
        $mem .= " Mb";
    }
    else
    {
        $mem .= " Kb";
    }
    
    return $mem;
}

function exec_time()
{
    if (!defined ('LARAVEL_START'))
    {
        return 0;
    }
    
    $time = microtime(true) - LARAVEL_START;
    
    if ($time > 100)
    {
        $time = round($time);
    }
    else if ($time > 10)
    {
        $time = round($time, 2);
    }
    else
    {
        $time = round($time, 3);
    }

    return $time . " Seconds";
}

function get_query_log($logs)
{
    foreach ($logs as $k => $log)
    {
        if ($log["bindings"])
        {
            foreach($log["bindings"] as $v)
            {
                $pos = strpos($log["query"], "?");
                
                if ($pos !== false) {
                    $log["query"] = substr_replace($log["query"], $v, $pos, 1);
                }
            }
            
            $logs[$k]["query"] = $log["query"];
        }
    }
    
    return $logs;
}

/**
 * return array to where sql string
 * @param type $conditions
 * @return string
 */
function get_where($conditions)
{
    $where = [];
    
    $raw_where = '';
    
    foreach($conditions as $operator => $data)
    {
        foreach($data as $arr)
        {
            if (isset($arr["field"]) && isset($arr["value"]))
            {
                $arr["op"] = isset($arr["op"]) ? $arr["op"] : "=";
                
                $where[] = $arr["field"] . " " . $arr["op"] . " '" . $arr["value"] . "'";
            }
            else
            {
                $where[] = get_where($arr);
            }            
        }
        
        $raw_where .= "(" . implode(" $operator ",  $where) . ")";
    }
    
    return $raw_where;
}