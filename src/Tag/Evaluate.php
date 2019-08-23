<?php

namespace EdsonOnildo\Tpl\Tag;

class Evaluate extends Tag
{
    public function __construct()
    {
        self::match('/[^@]{{(.*?)}}/', function ($cond) {

            self::replace("<?= $cond ?>");
        });
    }
}
