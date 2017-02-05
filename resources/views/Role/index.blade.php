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
                    <label class="col-md-2 control-label">Name</label>
                    <div class="col-md-3">
                        {{ Form::text('name', $search['name'], ["class" => "form-control"]) }}
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
                            <th> Name </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr class="center"> 
                                <td> {{ $record['id'] }} </td>
                                <td> {{ $record['name'] }} </td>
                                <td>
                                    @if (can("user/{" .$routePrefix . "}/edit")): ?>
                                    <a title="Edit" href="{{ url($routePrefix . "/" . $record['id'] . "/edit") }}" class="btn btn-icon-only blue">
                                        <i class=" fa fa-edit "></i> 
                                    </a>
                                    @endif
                                    
                                    @if (can("user/{" . $routePrefix . "}", "DELETE")): ?>
                                        {{ Form::open([ 'method' => 'DELETE', 'route' => [ $routePrefix . '.destroy', $record['id'] ], "class" => "inline" ]) }}

                                            <button class="btn btn-icon-only red" data-toggle="confirmation" data-singleton="true" data-popout="true"
                                                    data-original-title="Are you sure to Delete ?">
                                                <i class="fa fa-times "></i> 
                                            </button>

                                        {{ Form::close()}}
                                    @endif
                                </td>
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