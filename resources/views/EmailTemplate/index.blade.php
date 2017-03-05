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
                        {{ Form::text('code', $search['code'], ["class" => "form-control"]) }}
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
                            <th> @sortablelink('code', 'Code')  </th>
                            <th> Subject </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($records as $record)
                            <tr class="css-toggler center" data-toggler-class="hidden" data-href="#tr<?= $record['id']; ?>">
                                <td> {{ $record['id'] }} </td>
                                <td> {{ $record['code'] }} </td>
                                <td> {{ $record['subject'] }} </td>
                                <td>
                                    @if (can("user/{" .$routePrefix . "}/edit"))
                                    <a title="Edit" href="{{ url($routePrefix . "/" . $record['id'] . "/edit") }}" class="btn btn-icon-only blue">
                                        <i class=" fa fa-edit "></i> 
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            
                            <tr id="tr<?= $record['id']; ?>" class="hidden">
                                <td colspan="4" style="background-color:#EEF2F5; text-align: left;">
                                    <label><b>Placeholders</b></label><br/>
                                    <div class="portlet-body padding-5 has-margin-bottom-10">
                                        <?php 
                                            $placeholders = [];
                                            foreach(explode(",", $record['placeholder_ids']) as $id)
                                            {
                                                $placeholders[] = $placeholder_list[$id];
                                            }
                                        ?>
                                        <?php echo implode(",", $placeholders); ?>
                                    </div>

                                    <label><b>Body</b></label><br/>
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