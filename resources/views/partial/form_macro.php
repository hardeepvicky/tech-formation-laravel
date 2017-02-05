<?php
/* 
 * created 31-01-2017
 */

function array_to_str($arr, $glue = "=", $sep = " ")
{
    $str = array();
    
    foreach($arr as $k => $v)
    {
        if (!is_array($v) && !is_object($v))
        {
            $str[] = $k . $glue . '"' . $v . '"';
        }
    }
    
    return implode($sep, $str);
}

Form::macro('openGroup', function($type = null, $name = null, $attr = [], $errors = null) 
{
    if (!isset($attr["class"]))
    {
        $attr["class"] = "";
    }
    
    $attr["class"] .= " form-group";
    
    if ($errors && $name && $errors->has($name))
    {
        $attr["class"] .= " has-error";
    }
    
    $attr = array_to_str($attr);
    
    return "<div $attr>";
});

Form::macro('closeGroup', function() 
{
    return '</div>';
});

Form::macro('myLabel', function($title, $attr, $required = false) 
{
    if (!isset($attr["class"]))
    {
        $attr["class"] = "";
    }
    
    $attr["class"] .= " control-label";
    
    $attr = array_to_str($attr);
    
    $html = "<label $attr>$title";
    
    if ($required)
    {
        $html .= '<span class="required" aria-required="true"> * </span>';
    }
    
    $html .= "</label>";
    
    return $html;
});


Form::macro('myInput', function($type, $name, $attr = [], $errors = null) 
{
    $html = "";
    
    if (!isset($attr["class"]))
    {
        $attr["class"] = "";
    }
    
    $attr["class"] .= " form-control";
    
    $value = null;
    
    if (isset($attr["value"]))
    {
        $value = $attr["value"];
        unset($attr["value"]);
    }
    
    switch(strtolower($type))
    {
        case "text":
            $html = Form::text($name, $value, $attr);
            break;
        
        case 'select' :
            $list = [];
            
            if (isset($attr["empty"]))
            {
                $list[""] = $attr["empty"];
                
                unset($attr["empty"]);
            }
            
            $list += $attr['options'];
            
            unset($attr['options']);
            
            $html = Form::select($name, $list, $value, $attr);
            
            break;
        
        case 'email':
            $html = Form::email($name, $value, $attr);
            break;
        
        case 'password' :
            $html = Form::password($name, $attr);
            break;
        
        
    }

    if ($errors && $errors->has($name))
    {
        $html .= '<p class="help-block error">' . $errors->first($name) .'</p>';
    }

    return $html;
});


Form::macro('myGroup', function($type, $title, $name, $attr, $errors = null) 
{
    $html = Form::openGroup($type, $name, [], $errors);
    $html .= Form::myLabel($title, ['class' => 'col-md-3'], isset($attr["required"]));
    
    $html .= '<div class="col-md-4">';
    $html .= Form::myInput($type, $name, $attr, $errors);
    $html .= "</div>";
    
    $html .= Form::closeGroup();
    
    return $html;
});

function can($route, $method = "GET")
{
    $can = true;
    
    if (Session::has(ACL_KEY))
    {
        $list = Session::get(ACL_KEY);

        if (!isset($list[$method]) || !in_array($route, $list[$method]))
        {
            $can = false;
        }
    }

    return $can;
}