<?php
/* 
 * created 31-01-2017
 */
?>

<div class="page-header-inner">
    <!-- BEGIN LOGO -->
    <div class="page-logo">            
        <a href="/">
            <img src="/img/trinetra.png" alt="logo" class="logo-default" /> 
        </a>
        <div class="menu-toggler sidebar-toggler" style="margin-top : 28px;">
            <span></span>
        </div>
    </div>
    <!-- END LOGO -->

    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        <span></span>
    </a>

    <!-- BEGIN TOP NAVIGATION MENU -->
    <div class="top-menu">
        <ul class="nav navbar-nav pull-right">
            <li class="dropdown dropdown-user">
                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="fa fa-user"></i>
                    <span class="username username-hide-on-mobile"> 
                        @if (isset($authUser))
                            {{ $authUser["first_name"] }} {{ $authUser["last_name"] }}
                        @endif
                    </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-default">                                
                    <li>
                        @if (can("user/password/change"))
                        <a href="{{ url("user/password/change") }}">
                            <i class="icon-lock"></i> Change Password
                        </a>
                        @endif
                    </li>     
                    <li>
                        <a href="{{ url("logout") }}">
                            <i class="icon-key"></i> Log Out
                        </a>
                    </li> 
                </ul>
            </li>
        </ul>
    </div>
    <!-- END TOP NAVIGATION MENU -->
</div>