@extends('layouts.default')
@section('content')

@include('partial.form_macro')

<h3 class="page-title"> {{ $pageTitle }} </h3>

@include('partial.breadcum', array("routePrefix" => $routePrefix, "action" => $action))
@include('partial.message')

<div class="row">
    <div class="col-md-12">
        <div class="portlet-body">
            {{ Form::open(array('url' => url($routePrefix), "class" => "form-horizontal")) }}
            <div class="form-group">
                <div class="col-md-12" style="text-align: right;">
                    <a href="{{ url($routePrefix . "/refresh/0") }}" class="btn btn-default green-meadow">Refresh</a>                    
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </div>
            
            <div class="table-scrollable">
                <table class="table table-striped table-bordered table-hover summary">
                    <thead>
                        <tr class="center">
                            <th colspan="3"> Permissions ({{ count($permissions) }})</th>
                            @foreach($role_list as $id => $name)                            
                            <th width="80">
                                {{ $name }} (<span id="role-{{ $id }}-count"></span>)
                                <br/>
                                <input type="checkbox" class="chk-select-all chk-permission" 
                                       data-href=".chk-role-{{ $id }}"  
                                       data-info="span#role-{{ $id }}-count" />
                                
                            </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $per)
                            <tr class="center"> 
                                <th>
                                    {{ $per['name'] }}                                    
                                </th>
                                <th>
                                    {{ $per['type'] }}
                                </th>
                                <th>
                                    <input type="checkbox" class="chk-select-all" data-href=".chk-permission-{{ $per['id'] }}" />
                                </th>
                                
                                @foreach($role_list as $role_id => $role_name)                            
                                <td>
                                    <?php $attr = isset($role_permissions[$role_id][$per['id']]) ? 'checked="checked"' : ''; ?>
                                    <input type="checkbox" name="data[{{$role_id}}][{{$per['id']}}]" 
                                           value="1" 
                                           <?= $attr ?>
                                           class="chk-permission-{{ $per['id'] }} chk-role-{{ $role_id }}" 
                                           />
                                </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="form-group">
                <div class="col-md-12" style="margin-top: 20px; text-align: right;">
                    <button type="submit" class="btn btn-primary">Assign</button>
                </div>
            </div>
            
            {{ Form::close() }}
        </div>
    </div>
</div>

<script type="text/javascript">
    
    function count_permissions(_this, loaded)
    {
        var target = _this.data("href");
        var span = $(_this.data("info"));
        
        if (loaded)
        {
            $(target).change(function()
            {
                span.html($(target + ":checked").length);
            });
        }
        
        span.html($(target + ":checked").length);
    }
    
    $(".chk-permission").change(function()
    {
        count_permissions($(this), false);
    });
    
    $(document).ready(function()
    {
        $(".chk-permission").each(function()
        {
            count_permissions($(this), true);
        });
    });
</script>

@stop