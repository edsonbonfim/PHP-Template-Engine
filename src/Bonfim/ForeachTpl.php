<?php

namespace Bonfim\Component\View;

class ForeachTpl extends IfTpl
{
    private $pattern = '/{\s?foreach (.*?) as ([\w]+)\s?}(.*?){\s?\/foreach\s?}/is';

    private $block = '';
    private $array = '';
    private $callback = '';
    private $foreachContent = '';

    public function foreach() : void
    {
        if ($this->matchAll($this->pattern, $this->content)) {
            $this->iterate(function ($i) {
                $this->match = $this->matches[$i];
                $this->setBlock();
                $this->setArray();
                $this->setCallback();
                $this->setForeachContent();

                $content  = "<?php foreach({$this->array} as {$this->callback}): ?>";
                $content .= $this->foreachContent;
                $content .= "<?php endforeach; ?>";

                $this->content = str_replace($this->block, $content, $this->content);
            });
        }
    }

    private function setBlock() : void
    {
        $this->block = $this->match[0];
    }

    private function setArray() : void
    {
        $explode = explode('.', $this->match[1]);

        $variableArray = '$'.$explode[0];

        for ($i = 1; $i < count($explode); $i++) {
            $variableArray .= "['".$explode[$i]."']";
        }

        $this->array = $variableArray;
    }

    private function setCallback() : void
    {
        $this->callback = '$'.$this->match[2];
    }

    private function setForeachContent() : void
    {
        $this->foreachContent = trim($this->match[3]);
    }
}
