<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

include '../vendor/autoload.php';

use EdsonOnildo\Tpl\Tpl;

Tpl::setDev(true);
Tpl::setDir('view/');
Tpl::setUrl('http://localhost:3000/');
Tpl::setAssets('');

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
