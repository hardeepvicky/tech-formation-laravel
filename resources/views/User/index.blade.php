@extends('layouts.default')
@section('content')

@include('partial.form_macro')
<?php 
$records = $summary->toArray()["data"];
?>
<h3 class="page-title"> {{ $pageTitle }} </h3>

@include('partial.breadcum')
@include('partial.message')

<div class="row">
    <div class="portlet-body form">
        <form method="GET" class="form-horizontal">
            <div class="form-body">
                <div class="form-group">
                    <label class="col-md-2 control-label">Role</label>
                    <div class="col-md-3">
                        {!! Form::myInput("select", "role_id", ['options' => $role_list, "empty" => 'Please Select', "value" => $search['role_id']]) !!}
                    </div>
                    
                    <label class="col-md-2 control-label">Name, Email</label>
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
                            <th> @sortablelink('email', 'Email') </th>
                            <th> Role </th>
                            <th> @sortablelink('first_name', 'First Name') </th>
                            <th> @sortablelink('last_name', 'Last Name')  </th>
                            <th> @sortablelink('is_active', 'Active') </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr class="center"> 
                                <td> {{ $record['id'] }} </td>
                                <td> {{ $record['email'] }} </td>
                                <td> {{ $role_list[$record['role_id']] }} </td>
                                <td> {{ $record['first_name'] }} </td>
                                <td> {{ $record['last_name'] }} </td>
                                <td>
                                    <?php if (can('user/{ID}/active/toggle/{v}')): ?>
                                        <a class="ajax-toggle-status" href='{{ url($routePrefix . "/" . $record["id"] . "/active/toggle/{v}") }}' data-value="{{ $record['is_active'] ? 1 : 0 }}" >
                                            <i class="font-lg {{ $record['is_active'] ? "fa fa-check-circle font-green-meadow": "fa fa-times-circle font-red-sunglo" }}"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (can('user/{user}/edit')): ?>
                                        <a title="Edit" href="{{ url($routePrefix . "/" . $record['id'] . "/edit") }}" class="btn btn-icon-only blue">
                                            <i class=" fa fa-edit "></i> 
                                        </a>
                                    <?php endif; ?>
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