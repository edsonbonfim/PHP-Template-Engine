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

    public function handle(): string
    {
        return '<?php '.$this->match[1].'('.$this->match[2].'); ?>';
    }
}
