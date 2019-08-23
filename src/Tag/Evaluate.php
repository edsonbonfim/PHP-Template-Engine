<?php

namespace Bonfim\Tpl\Tag;

class Evaluate extends Tag
{
    public function __construct()
    {
        self::match('/([^@]){{(.*?)}}/', function ($scape, $cond) {

            self::replace("$scape<?= $cond ?>");
        });

        self::match('/@{{/', function () {

            self::replace("{{");
        });
    }
}
