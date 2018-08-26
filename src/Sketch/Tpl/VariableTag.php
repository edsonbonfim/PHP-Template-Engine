<?php

namespace Sketch\Tpl;

/**
 * Class VariableTag
 * @package Sketch\Tpl
 */
class VariableTag extends Tag
{
    public function __construct()
    {
        parent::__construct('/{{(\s?)+([\w\.]+)(\s?)+\|?(\s?)+([\w|]+)?(\s?)+}}/is');
    }

    public function handle(array $match): string
    {
        $filters = explode('|', $match[5]);

        $res = "<?= ";
        
        foreach ($filters as $filter) {
            $res .= "$filter(";
        }

        $res .= $this->getVar();

        foreach ($filters as $filter) {
            $res .= ")";
        }

        $res .= " ?>";

        return $res;
    }

    private function getVar(): string
    {
        $explode = explode('.', $this->match[2]);

        $variable = $explode[0];

        $variable = '$'.$variable;

        for ($k = 1; $k < count($explode); $k++) {
            $variable .= "->".$explode[$k];
        }

        return $variable;
    }
}
