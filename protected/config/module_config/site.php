<?php
return array(
    'urlManager'=>array(
        ""=>"site/index",
        "contacts"=>"site/contacts",
        "application"=>"site/application",
        "userlogin"=>"client/loginUser",
        "cart"=>"site/cart",
        "cartinfo"=>"site/cartinfo",
        "search"=>"site/search",
        "<_c:(profile|user|client|profileblog)>"=>"<_c>/index",
        "<_c:(profile|user|client|profileblog)>/<_a>"=>"<_c>/<_a>",
        "<_a:(login|logout|register)>"=>"user/<_a>",
        "<_c>/<_a:(captcha)>/refresh"=>"<_c>/<_a>",
        "<_c>/<_a:(captcha)>/<v>"=>"<_c>/<_a>",
        "<url:([0-9a-z\/_-]+)>/"=>"site/page",
    )
);