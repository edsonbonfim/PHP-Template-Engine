<?php

include '../vendor/autoload.php';

use EdsonOnildo\Tpl\Tpl;

Tpl::config([
    'dev' => true,
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

Tpl::render('index');
