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
                        {!! Form::myInput("select", "type", ['options' => $cron_types, "empty" => 'Please Select', "value" => $search['type']]) !!}
                    </div>
                    
                    <label class="col-md-2 control-label">Status</label>
                    <div class="col-md-3">
                        {!! Form::myInput("select", "status", ['options' => [1 => "Success", 0 => "Failure"], "empty" => 'Please Select', "value" => $search['status']]) !!}
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

<div class="row">
    <div class="col-md-12">
        @include('partial.pagination')
        
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-hover summary">
                    <thead>
                        <tr class="center">
                            <th> # </th>
                            <th> Type </th>
                            <th> Time Taken (seconds) </th>
                            <th> Status </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr class="css-toggler center" data-toggler-class="hidden" data-href="#tr<?= $record['id']; ?>">                                
                                <td> {{ $record['id'] }} </td>
                                <td> {{ $cron_types[$record['type']] }} </td>
                                <td> {{ $record['execution_time'] }} </td>
                                <td>
                                    <i class="font-lg {{ $record['status'] ? "fa fa-check-circle font-green-meadow": "fa fa-times-circle font-red-sunglo" }}"></i>
                                </td>
                            </tr>
                            <tr id="tr<?= $record['id']; ?>" class="hidden">
                                <?php echo $record['description']; ?>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        @include('partial.pagination', ["show_pagination_info" => false])
    </div>
</div>
@stop