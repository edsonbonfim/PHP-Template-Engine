<?php

include '../vendor/autoload.php';

use Sketch\Tpl;

try {
    Tpl::config([
        //'environment'  => 'production',
        'environment' => 'development',
        'template_dir' => 'view',
        'cache_dir' => 'cache'
    ]);
} catch (Exception $e) {
    echo $e->getMessage();
}

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
