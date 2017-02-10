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
                    <label class="col-md-2 control-label">Email</label>
                    <div class="col-md-4">
                        {!! Form::myInput("text", "email", ["value" => $search['email'], 'placeholder' => "From Email, To Email, Subject, Content"]) !!}
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
                            <th> @sortablelink('from_email', 'From Email') </th>
                            <th> @sortablelink('to_email', 'To Email') </th>
                            <th> Sent On </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr class="css-toggler center" data-toggler-class="hidden" data-href="#tr<?= $record['id']; ?>">                                
                                <td> {{ $record['id'] }} </td>
                                <td> {{ $record['from_email'] }} </td>
                                <td> {{ $record['to_email'] }} </td>
                                <td> {{ DateUtility::getDate($record['created_at'], 'd-M-Y h:i a') }} </td>
                            </tr>
                            <tr id="tr<?= $record['id']; ?>" class="hidden">
                                <td colspan="5" style="background-color:#EEF2F5; text-align: left;">
                                    <label><b>Subject</b></label> : <?php echo $record['subject']; ?>
                                    <br/>
                                    <div class="portlet-body padding-5">
                                        <?php echo $record['body']; ?>
                                    </div>
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