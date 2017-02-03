<?php
return [    
    [
        "title" => "Users",
        "icon_class" => "fa fa-user",
        "links" => [
            [
                "title" => "Summary",
                "route" => "user",
                "other_routes" => [],
                "icon_class" => "fa fa-navicon"
            ],
            [
                "title" => "Create",
                "route" => "user/create",
                "other_routes" => [
                    "user/{User}/edit"
                ],
                "icon_class" => "fa fa-plus-circle"
            ]
        ]
    ],
    [
        "title" => "Logs",
        "icon_class" => "fa fa-link",
        "links" => [
            [
                "title" => "Web Service",
                "route" => "log/web-service",
                "other_routes" => [],
                "icon_class" => "fa fa-navicon"
            ],            
            [
                "title" => "Cron",
                "route" => "log/cron",
                "other_routes" => [],
                "icon_class" => "fa fa-navicon"
            ],            
        ]
    ],
    
];