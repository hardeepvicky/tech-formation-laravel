<?php
    $show_action_links = isset($show_action_links) ? $show_action_links : true;
?>

<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="/">
                <i class="fa fa-home"></i>Home
            </a>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            <span>
                <a href="{{ url($routePrefix) }}">  {{ str_replace("_", " ", title_case($routePrefix)) }} Manager </a>
            </span>
            <i class="fa fa-angle-right"></i>
        </li>
        <li>
            @if($action == "index")            
                Summary
            @else            
            {{ str_replace("_", " ", title_case($action)) }}
            @endif
        </li>

    </ul>
    @if($show_action_links)
    <div class="page-toolbar">
        <div class="btn-group pull-right">
            @if($action == "index")
            <a href="{{ url($routePrefix . "/create") }}">
                <button type="button" class="btn green-meadow">  
                    <i class="fa fa-plus"></i> Add
                </button>
            </a>
            @else
            <a href="{{ url($routePrefix) }}">
                <button type="button" class="btn green-meadow">  
                    <i class="fa fa-angle-left"></i> Back
                </button>
            </a>
            @endif
        </div>
    </div>
    @endif
</div>