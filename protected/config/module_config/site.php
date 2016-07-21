<?php
return array(
    'urlManager' => array(
        "" => "site/index",
        "contacts" => "feedback/contacts",
        "application" => "site/application",
        "cart" => "site/cart",
        "cartinfo" => "site/cartinfo",
        "search" => "site/search",
        "order" => "site/order",
        "map" => "site/map",
        "<_c:(profile|user|client|profileblog)>"=>"<_c>/index",
        "<_c:(profile|user|client|profileblog)>/<_a>"=>"<_c>/<_a>",
        "<_a:(hslogin|logout|register)>"=>"user/<_a>",
        "<_c>/<_a:(captcha)>/refresh"=>"<_c>/<_a>",
        "<_c>/<_a:(captcha)>/<v>"=>"<_c>/<_a>",
        "<url:([0-9a-z\/_-]+)>/"=>"site/page",
    )
);