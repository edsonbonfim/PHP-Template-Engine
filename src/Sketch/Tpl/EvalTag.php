<?php

namespace Sketch\Tpl;

class EvalTag extends Tag
{
    public function __construct()
    {
        parent::__construct('/{(\s?)+([\w]+)(\s?)+=(\s?)+(.*?)(\s?)+}/is');
    }
    
    public function handle(array $match): string
    {
        return "<?php \$$match[2] = $match[5] ?>";
    }
}
