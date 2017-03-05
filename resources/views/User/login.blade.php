@extends('layouts.login')
@section('content')
<div class="content">
    {{ Form::open(array("method" => "POST", 'url' => url("login/attempt"), "class" => "form-horizontal login-form")) }}
        <h3 class="form-title font-green">Sign In</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> Enter any username and password. </span>
        </div>
        
        <div class="form-group">
            @include('partial.message')
        </div>
        
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Username</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" placeholder="Username" name="email"> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" placeholder="Password" name="password"> </div>
        <div class="form-actions pull-right" style="border:none;">
            <button type="submit" class="btn green uppercase">Login</button>            
        </div>
        
    {{ Form::close() }}
</div>
@stop