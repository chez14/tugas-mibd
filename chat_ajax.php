<?php
require('config/autoload.php');
Helper\Ajaxify::boot();

Helper\Ajaxify::serve([[
    "konten"=>"Kambing!",
    "is_client"=>false,
    "created_at"=>time()
]]);