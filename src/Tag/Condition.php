<?php

namespace Bonfim\Tpl\Tag;

class Condition extends Tag
{
    public function __construct()
    {
        $this->if();
        $this->elseif();
        $this->else();
        $this->endif();
    }

    public function if()
    {
        self::match('/@\s*if\s*\((.*?)\)/', function($cond) {

            self::replace("<?php if ($cond) : ?>");
        });
    }

    public function elseif() {
        self::match('/@\s*elseif\s*\((.*?)\)/', function($cond) {

            self::replace("<?php elseif ($cond) : ?>");
        });
    }

    public function else()
    {
        self::match('/@\s*else/', function () {

            self::replace("<?php else : ?>");
        });
    }

    public function endif()
    {
        $regex = '/@\s*\/if/';

        self::match($regex, function () {

            self::replace("<?php endif ?>");
        });
    }
}
