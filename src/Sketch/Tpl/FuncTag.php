<?php

namespace Sketch\Tpl;

/**
 * Class FuncTag
 * @package Sketch\Tpl
 */
class FuncTag extends Tag
{
    public function __construct()
    {
        parent::__construct('/{\s?func ([\w]+)\((.*?)\)\s?}/is');
    }

    public function handle(array $match): string
    {
        return '<?php '.$match[1].'('.$match[2].'); ?>';
    }
}
