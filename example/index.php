<?php

include '../vendor/autoload.php';

use Bonfim\Tpl;

Tpl::config([
    'template_dir' => 'view',
    'cache_dir'    => 'cache'
]);

Tpl::assign('status', true);
Tpl::assign('title', 'BonfimTPL');
Tpl::assign('authors', [
    [
        "name"     => "Edson Onildo",
        "homepage" => "https://github.com/EdsonOnildoJR",
    ],
    [
        "name"     => "All Contributors",
        "homepage" => "https://github.com/EdsonOnildoJR/BonfimTPL/contributors",
    ]
]);

echo Tpl::render('index');
