@extends('layouts.default')
@section('content')

<h3 class="page-title"> {{ $pageTitle }} </h3>

@include('partial.breadcum', array("routePrefix" => $routePrefix, "action" => $action))
@include('partial.message')

<div class="row">
    <div class="portlet-body form">
        
        {{ Form::open(array('url' => url($routePrefix), "class" => "form-horizontal")) }}
            @include($routePrefix .".partial.form")
        {{ Form::close() }}
    </div>
</div>
@stop