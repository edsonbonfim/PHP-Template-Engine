<?php

namespace Bonfim\Tpl;

class FuncTpl
{
    private $pattern = '/{\s?func ([\w]+)\((.*?)\)\s?}/is';
    private $content;
    private $match;
    private $funcName;
    private $funcArgs;

    public function __construct(string $content)
    {
        $this->content = $content;
        $this->func();
    }

    public function __toString(): string
    {
        return $this->content;
    }

    public function func(): void
    {
        if (preg_match_all($this->pattern, $this->content, $matches, PREG_SET_ORDER)) {
            for ($i = 0; $i < count($matches); $i++) {
                $this->match = $matches[$i];
                $this->setFuncName();
                $this->setFuncArgs();
                $content = '<?php echo('.$this->funcName.'('.$this->funcArgs.')); ?>';
                $this->content = str_replace($matches[$i][0], $content, $this->content);
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
