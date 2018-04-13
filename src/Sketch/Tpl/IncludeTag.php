<?php

namespace Sketch\Tpl;

class IncludeTag extends Tag
{
    private $pattern = '/{\s?include \'?"?(.*?)"?\'?\s?}/is';

    public function handle(): void
    {
        if (preg_match_all($this->pattern, self::$content, $matches, PREG_SET_ORDER)) {
            for ($i = 0; $i < count($matches); $i++) {
                $match = $matches[$i];
                $replace = file_get_contents(self::$config['template_dir'] . "/{$match[1]}.html");
                self::$content = str_replace($matches[$i][0], $replace, self::$content);
            };
        }
    }
}
