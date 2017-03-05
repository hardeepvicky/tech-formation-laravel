@extends('layouts.default')
@section('content')
@include('partial.form_macro')
<h3 class="page-title"> {{ $pageTitle }} </h3>

@include('partial.breadcum', array("routePrefix" => $routePrefix, "action" => $action))
@include('partial.message')


<div class="row">
    <div class="portlet-body form">
        <form class="form-horizontal" method="POST" action="<?= url("user/password/update"); ?>">
            {{ Form::token() }}
            <div class="form-body">

            {!! Form::myGroup("password", "Current Password", "current_password", ['required' => true], $errors) !!}
                
            {!! Form::myGroup("password", "New Password", "password", ['required' => true], $errors) !!}

            {!! Form::myGroup("password", "Confirm Password", "password_confirmation", ['required' => true], $errors) !!}
            
                <div class="form-group">
                    <div class="col-md-offset-3 col-md-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn default">Cancel</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@stop