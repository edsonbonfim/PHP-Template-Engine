<?php

namespace Sketch\Tpl;

/**
 * Class FuncTag
 * @package Sketch\Tpl
 */
class FuncTag extends Tag
{
    /**
     * @var
     */
    private $funcName;
    /**
     * @var
     */
    private $funcArgs;

    public function __construct()
    {
        parent::__construct('/{\s?func ([\w]+)\((.*?)\)\s?}/is');
    }

    public function handle(): void
    {
        $this->setFuncName();
        $this->setFuncArgs();
        
        $content = '<?php '.$this->funcName.'('.$this->funcArgs.'); ?>';
        self::$content = str_replace($this->match[0], $content, self::$content);
    }

    private function setFuncName()
    {
        $this->funcName = $this->match[1];
    }

    private function setFuncArgs()
    {
        $this->funcArgs = $this->match[2];
    }
}
