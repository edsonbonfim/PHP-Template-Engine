<?php

namespace Bonfim\Tpl\Tag;

class Loop extends Tag
{
    public function __construct()
    {
        $this->foreach();
        $this->endforeach();

        $this->for();
        $this->endfor();
    }

    private function for()
    {
        self::match('/@\s*for\s*\((.*?)\)/', function ($cond) {

            self::replace("<?php for ($cond) : ?>");
        });
    }

    private function endfor()
    {
        self::match('/@\s*\/for/', function () {

            self::replace("<?php endfor ?>");
        });
    }

    private function foreach()
    {
        self::match('/@\s*foreach\s*\((.*?)\)/', function ($cond) {

            self::replace("<?php foreach ($cond) : ?>");
        });
    }

    private function endforeach()
    {
        self::match('/@\s*\/foreach/', function () {

            self::replace("<?php endforeach ?>");
        });
    }
}
