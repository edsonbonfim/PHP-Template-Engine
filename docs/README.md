# BonfimTPL 1.0 Documentation

[![Latest Version][ico-version]][link-version]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![StyleCI][ico-styleci]][link-styleci]
[![Total Downloads][ico-downloads]][link-downloads]

This is the full documentation for BonfimTPL 1.0.x

# Prerequisites

BonfimTPL requires **PHP >= 7.1.0**

# Table of Contents

* [Installation](installation.md)
* [Basic Usage](#basic-usage)
* [BonfimTPL Tags](#bonfimtpl-tags)
    * [Variables](#variables)
    * [Conditional Expression](#conditional-expression)
    * [Loop](#loop)
    * [Function](#function)
    * [Include](#include)
* [Contributing](#contributing)
* [Security](#security)
* [Credits](#credits)
* [License](#license)

# Basic usage

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

# BonfimTPL Tags

* [Variables](#variables)
* [Conditional Expression](#conditional-expression)
* [Loop](#loop)
* [Function](#function)
* [Include](#include)

## Variables

Variables are the dynamic content of the template, valorized on the execution of the script with Tpl::assing() static method. Variables names are case sensitive.

**Template:**
``` html
Welcome to {title}
```

**Data:**
``` php
<?php

Tpl::assign('title', 'BonfimTPL');
```

**Output:**
``` html
Welcome to BonfimTPL
```

### Modifiers on variables

You can add modifiers that are executed on the variables.

**Template:**
``` html
Hello {name|ucwords}!
```

**Data:**
``` php
<?php

Tpl::assign('name', 'edson onildo');
```

**Output:**
``` html
Hello Edson Onildo!
```

## Conditional Expression

Checks an expression and print the code between {if}{else} if the conditions is true or {else}{/if} if the condition is false. Try to use nested blocks :)

**Template:**
``` html
{if age >= 18}
    Adult
{else}
    Minor
{/if}
```

**Data:**
``` php
<?php

Tpl::assign('age', 19);
```

**Output:**
``` html
Adult
```

you can also use the {if condition}content{elseif condition}content{else}content{/if} or any combination of if and else.

## Loop

Allow to loop through the value of arrays or objects.

**Template:**
``` html
{foreach authors as author}
    {author.name}: {author.homepage}
{/foreach}
```

**Data:**
``` php
<?php

$authors = [
    [
        'name'     => 'Edson Onildo',
        'homepage' => 'https://github.com/EdsonOnildoJR'
    ],
    [
        'name'     => 'Contributors',
        'homepage' => 'https://github.com/EdsonOnildoJR/BonfimTPL/contributors'
    ]
];

Tpl::assign('authors', $authors);
```

**Output:**
``` html
Edson Onildo: https://github.com/EdsonOnildoJR
Contributors: https://github.com/EdsonOnildoJR/BonfimTPL/contributors
```

## Function

Use {func  funcname()} tag to execute a PHP function and print the result. You can pass strings, numbers and variables as parameters.

**Template:**
``` html
{func date('Y')}
```

**Output:**
``` html
2018
```

## Include

With **{include 'template'}** tag you can include external template as blocks.

**Template:**
``` html
<h1>New user:</h1>
{template 'userForm'}
```

**Output:**
``` html
<h1>New user:</h1>
<form class="user" action="" method="post">
    ...
</form>
```

## Contributing

Please see [CONTRIBUTING](../CONTRIBUTING.md) and [CODE_OF_CONDUCT](../CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email inbox.edsononildo@gmail.com instead of using the issue tracker.

## Credits

- [Edson Onildo][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](../LICENSE.md) for more information.

[ico-version]: https://img.shields.io/github/release/EdsonOnildoJR/BonfimTPL.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/EdsonOnildoJR/BonfimTPL/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/EdsonOnildoJR/BonfimTPL.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/EdsonOnildoJR/BonfimTPL.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/124528765/shield?branch=master
[ico-downloads]: https://img.shields.io/packagist/dt/bonfim/view.svg?style=flat-square

[link-version]:https://github.com/thephpleague/uri-parser/releases
[link-travis]: https://travis-ci.org/EdsonOnildoJR/BonfimTPL
[link-scrutinizer]: https://scrutinizer-ci.com/g/EdsonOnildoJR/BonfimTPL/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/EdsonOnildoJR/BonfimTPL
[link-styleci]: https://styleci.io/repos/124528765
[link-downloads]: https://packagist.org/packages/bonfim/view
[link-author]: https://github.com/EdsonOnildoJR
[link-contributors]: ../../../contributors
