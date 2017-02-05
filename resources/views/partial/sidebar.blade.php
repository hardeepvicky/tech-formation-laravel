<?php
/* 
 * created 31-01-2017
 */

$menus = config("menus");

?>

<div class="page-sidebar navbar-collapse collapse">                            
    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">                            
        @foreach($menus as $menu)
            <?php
                $active = false;
                foreach($menu['links'] as $link)
                {
                    if ($link["route"] == $route || in_array($route, $link["other_routes"]))
                    {
                        $active = true;
                    }
                }
            ?>
            <li class="nav-item start {{ $active ? "active open" : "" }}}">
                <a href="javascript:;" class="nav-link nav-toggle">
                    <i class="{{ $menu["icon_class"] }}"></i>
                    <span class="title">{{ $menu["title"] }}</span>
                    <span class="selected"></span>
                    <span class="arrow {{ $active ? "open" : ""}}"></span>
                </a>

                <ul class="sub-menu">
                    @foreach($menu['links'] as $link)
                    <?php $active = $link["route"] == $route || in_array($route, $link["other_routes"]); ?>
                        <?php if (!isset($routes_permitted) || (isset($routes_permitted["GET"]) && in_array($link["route"], $routes_permitted["GET"]))): ?>
                            <li class="nav-item {{ $active ? "active open" : "" }}">
                                <a href="{{ url($link["route"]) }}" class="nav-link">
                                    <i class="{{ $link["icon_class"] }}"></i>
                                    <span class="title">{{ $link["title"] }}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                        <?php endif; ?>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>   
</div>

<script type="text/javascript">
    $("ul.sub-menu:not(:has(li))").parent().remove();
</script>