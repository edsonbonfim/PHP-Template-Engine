<?php

namespace Bonfim\Component\View;

class FuncTpl extends VariableTpl
{
    private $funcName;
    private $funcArgs;

    public function func() : void
    {
        if ($this->matchAll('/{\s?func ([\w]+)\((.*?)\)\s?}/is', $this->content)) {
            $this->iterate(function ($i) {
                $this->match = $this->matches[$i];
                $this->setFuncName();
                $this->setFuncArgs();
                $content = '<?php echo('.$this->funcName.'('.$this->funcArgs.')); ?>';
                $this->content = str_replace($this->matches[$i][0], $content, $this->content);
            });
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
