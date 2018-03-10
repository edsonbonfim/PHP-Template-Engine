<?php

include '../vendor/autoload.php';

use Bonfim\Component\View\View;

View::config([
    'template_dir' => 'view',
    'cache_dir'    => 'cache'
]);

View::assign('title', 'Bonfim View Component');
View::assign('authors', [
    [
        "name"     => "Edson Onildo",
        "homepage" => "https://github.com/EdsonOnildoJR",
    ],
    [
        "name"     => "All Contributors",
        "homepage" => "https://github.com/BonfimSystems/View/contributors",
    ]
]);

echo View::render('index');
