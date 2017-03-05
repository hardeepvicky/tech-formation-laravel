<?php 
$password_attr = $action == "edit" ? ["disabled" => "disabled"] : [];
?>
@include('partial.form_macro')

<div class="form-body">
    
    {!! Form::myGroup("select", "Role", "role_id", ['required' => true, 'options' => $role_list, "empty" => 'Please Select'], $errors) !!}
    
    {!! Form::myGroup("text", "First Name", "first_name", ['required' => true], $errors) !!}
    
    {!! Form::myGroup("text", "Last Name", "last_name", [], $errors) !!}
    
    {!! Form::myGroup("email", "Email", "email", ['required' => true], $errors) !!}
    
    @if ($action == "create")    
        {!! Form::myGroup("password", "Password", "password", ['required' => true], $errors) !!}
    
        {!! Form::myGroup("password", "Confirm Password", "password_confirmation", ['required' => true], $errors) !!}
    @endif

    <div class="form-group">
        <div class="col-md-offset-3 col-md-3">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="reset" class="btn default">Cancel</button>
        </div>
    </div>
</div>
