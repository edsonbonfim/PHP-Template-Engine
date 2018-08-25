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

    public function handle(array $match): string
    {
        return file_get_contents(self::$config['template_dir'] . "/{$match[1]}.html");
    }
}
