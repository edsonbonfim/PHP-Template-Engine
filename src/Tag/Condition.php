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
        self::match('/\s*@\s*if\s*\((.*?)\)\s*$/m', function($cond) {
            self::replace("<?php if ($cond) : ?>");
        });
    }

    public function elseif() {
        self::match('/\s*@\s*elseif\s*\((.*?)\)\s*$/m', function($cond) {
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
        self::match('/@\s*\/if/', function () {
            self::replace("<?php endif ?>");
        });

        self::match('/@\s*endif/', function () {
            self::replace("<?php endif ?>");
        });
    }
}
