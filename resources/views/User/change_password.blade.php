@extends('layouts.default')
@section('content')

<h3 class="page-title"> {{ $pageTitle }} </h3>

@include('partial.breadcum', array("routePrefix" => $routePrefix, "action" => $action))
@include('partial.message')
<div class="row">
    <div class="portlet-body form">
        
        {{ Form::open(array("method" => "PUT", 'url' => url($routePrefix . "/password/update"), "class" => "form-horizontal")) }}
        
        <div class="form-body">
            <div class="form-group {{ $errors->has('old_password') ? "has-error" : "" }}">
                <label class="col-md-3 control-label">Password <span class="required" aria-required="true"> * </span></label>
                <div class="col-md-4">
                    {{ Form::password('old_password', array('class' => 'form-control')) }}

                    @if ($errors->has('old_password'))
                        <p class="help-block error">{{ $errors->first('old_password') }}</p> 
                    @endif
                </div>        
            </div>
            
            <div class="form-group {{ $errors->has('password') ? "has-error" : "" }}">
                <label class="col-md-3 control-label">New Password <span class="required" aria-required="true"> * </span></label>
                <div class="col-md-4">
                    {{ Form::password('password', array('class' => 'form-control')) }}

                    @if ($errors->has('password'))
                        <p class="help-block error">{{ $errors->first('password') }}</p> 
                    @endif
                </div>        
            </div>
            
            <div class="form-group {{ $errors->has('password_confirmation') ? "has-error" : "" }}">
                <label class="col-md-3 control-label">Confirm Password <span class="required" aria-required="true"> * </span></label>
                <div class="col-md-4">
                    {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

                    @if ($errors->has('password_confirmation'))
                        <p class="help-block error">{{ $errors->first('password_confirmation') }}</p> 
                    @endif
                </div>        
            </div>
            
            <div class="form-group">
                <div class="col-md-offset-3 col-md-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn default">Cancel</button>
                </div>
            </div>
        </div>
        
        {{ Form::close() }}
    </div>
</div>

@stop