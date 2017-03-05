@extends('layouts.default')
@section('content')

@include('partial.form_macro')
<?php 
$records = $summary->toArray()["data"];
?>
<h3 class="page-title"> {{ $pageTitle }} </h3>

@include('partial.breadcum', array("routePrefix" => $routePrefix, "action" => $action))
@include('partial.message')

<div class="row">
    <div class="portlet-body form">
        <form method="GET" class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-2 control-label">Type</label>
                    <div class="col-md-3">
                        {!! Form::myInput("select", "type", ['options' => $web_service_types, "empty" => 'Please Select', "value" => $search['type']]) !!}
                    </div>
                    
                    <label class="col-md-2 control-label">Status</label>
                    <div class="col-md-3">
                        {!! Form::myInput("select", "status", ['options' => [1 => "Success", 0 => "Failure"], "empty" => 'Please Select', "value" => $search['status']]) !!}
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-2 control-label">Type</label>
                    <div class="col-md-3">
                        {!! Form::myInput("text", "from_date", ['id' => 'from-date', 'class' => 'datepicker', 'data-datepicker-end' => 'input#to-date']) !!}
                    </div>
                    
                    <label class="col-md-2 control-label">Status</label>
                    <div class="col-md-3">
                        {!! Form::myInput("text", "from_date", ['id' => 'to-date', 'class' => 'datepicker', 'data-datepicker-start' => 'input#from-date']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-offset-2 col-md-3">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <a href="{{ url($routePrefix) }}" class="btn default">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@include($routePrefix .".partial.web_service_summary")
@stop