<?php

namespace Sketch\Tpl;

/**
 * Class IncludeTag
 * @package Sketch\Tpl
 */
class IncludeTag extends Tag
{

    public function __construct()
    {
        parent::__construct('/{\s?include \'?"?(.*?)"?\'?\s?}/is');
    }

    public function handle(): void
    {
        $replace = file_get_contents(self::$config['template_dir'] . "/{$this->match[1]}.html");
        self::$content = str_replace($this->match[0], $replace, self::$content);
    }
}
