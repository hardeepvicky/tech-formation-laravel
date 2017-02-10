@extends('layouts.default')
@section('content')

<h3 class="page-title"> {{ $pageTitle }} </h3>

@include('partial.breadcum', array("routePrefix" => $routePrefix, "action" => $action))
@include('partial.message')

<div class="row">
    <div class="portlet-body form">
        {{ Form::model($model, array('url' => url($routePrefix . "/" . $model->id), 'method' => 'PUT', "class" => "form-horizontal")) }}
            @include($modelName .".partial.form")
        {{ Form::close() }}
    </div>
</div>
@stop