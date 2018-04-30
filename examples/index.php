<?php

include '../vendor/autoload.php';

use Sketch\Tpl;

Tpl::config([
    //'environment'  => 'production',
    'environment' => 'development',
    'template_dir' => 'view',
    'cache_dir' => 'cache'
]);

Tpl::assign('status', true);
Tpl::assign('title', 'Sketch');
Tpl::assign('authors', [
    [
        "name"     => "Edson Onildo",
        "page" => "https://github.com/EdsonOnildoJR",
    ],
    [
        "name"     => "All Contributors",
        "page" => "https://github.com/EdsonOnildoJR/Sketch/contributors",
    ]
]);

echo Tpl::render('index');
