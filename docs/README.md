# BonfimTPL 1.0 Documentation

[![Latest Version][ico-version]][link-version]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![StyleCI][ico-styleci]][link-styleci]
[![Total Downloads][ico-downloads]][link-downloads]

This is the full documentation for BonfimTPL 1.0.x

# Getting started

BonfimTPL is an PHP template engine and provide a better way to produce dynamic web pages.

## Prerequisites

BonfimTPL requires **PHP >= 7.1.0**

## Installation

Install composer [https://getcomposer.org/download/](https://getcomposer.org/download/)

Create a **composer.json** inside your application folder:
``` json
{
    "require": {
        "bonfim/tpl": ">=1.0.0"
    }
}
```

Open the command line and run the following:
``` sh
$ composer install
```

## Basic usage

### Setup

Create an **index.php** file and require the autoload.php of Composer

``` php
<?php

include 'vendor/autoload.php';
```

After that, let's to do all necessary configuration

``` php
<?php

use Bonfim\Tpl;

Tpl::config([
    'template_dir' => 'path/to/templates',
    'cache_dir'    => 'path/to/caches'
]);
```

### What are you waiting for?

Assign and render template

``` php
<?php

Tpl::assing('title', 'Hello!');
Tpl::render('test');
```

[ico-version]: https://img.shields.io/github/release/BonfimSystems/View.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/BonfimSystems/View/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/BonfimSystems/View.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/BonfimSystems/View.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/124528765/shield?branch=master
[ico-downloads]: https://img.shields.io/packagist/dt/bonfim/view.svg?style=flat-square

[link-version]:https://github.com/thephpleague/uri-parser/releases
[link-travis]: https://travis-ci.org/BonfimSystems/View
[link-scrutinizer]: https://scrutinizer-ci.com/g/BonfimSystems/View/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/BonfimSystems/View
[link-styleci]: https://styleci.io/repos/124528765
[link-downloads]: https://packagist.org/packages/bonfim/view
[link-author]: https://github.com/EdsonOnildoJR
[link-contributors]: ../../contributors
