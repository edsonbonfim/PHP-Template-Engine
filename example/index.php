<?php

include '../vendor/autoload.php';

use Sketch\Tpl;

Tpl::config([
    'template_dir' => 'view',
    'cache_dir'    => 'cache'
]);

Tpl::assign('status', true);
Tpl::assign('title', 'Sketch');
Tpl::assign('authors', [
    [
        "name"     => "Edson Onildo",
        "homepage" => "https://github.com/EdsonOnildoJR",
    ],
    [
        "name"     => "All Contributors",
        "homepage" => "https://github.com/EdsonOnildoJR/Sketch/contributors",
    ]
]);

echo Tpl::render('index');
