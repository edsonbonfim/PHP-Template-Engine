<?php

namespace Sketch\Tpl;

/**
 * Class FuncTag
 * @package Sketch\Tpl
 */
class FuncTag extends Tag
{
    /**
     * @var string
     */
    private $pattern = '/{\s?func ([\w]+)\((.*?)\)\s?}/is';
    /**
     * @var
     */
    private $match;
    /**
     * @var
     */
    private $funcName;
    /**
     * @var
     */
    private $funcArgs;

    public function handle(): void
    {
        if (preg_match_all($this->pattern, self::$content, $matches, PREG_SET_ORDER)) {
            for ($i = 0; $i < count($matches); $i++) {
                $this->match = $matches[$i];
                $this->setFuncName();
                $this->setFuncArgs();
                $content = '<?php '.$this->funcName.'('.$this->funcArgs.'); ?>';
                self::$content = str_replace($matches[$i][0], $content, self::$content);
            };
        }
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
