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
        self::match('/\s*@\s*for\s*\((.*?)\)\s*$/m', function ($cond) {
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
        self::match('/\s*@\s*foreach\s*\((.*?)\)\s*$/m', function ($cond) {
            self::replace("<?php foreach ($cond) : ?>");
        });
    }

    private function endforeach()
    {
        self::match('/@\s*\/foreach/', function () {
            self::replace("<?php endforeach ?>");
        });

        self::match('/@\s*endforeach/', function () {
            self::replace("<?php endforeach ?>");
        });
    }
}
