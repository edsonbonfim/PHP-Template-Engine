<?php

namespace Bonfim\Tpl;

class ForeachTpl
{
    private $pattern = '/{\s?foreach (.*?) as ([\w]+)\s?}(.*?){\s?\/foreach\s?}/is';
    private $content;
    private $block = '';
    private $array = '';
    private $callback = '';
    private $foreachContent = '';
    private $match;

    public function __construct(string $content)
    {
        $this->content = $content;
        $this->foreach();
    }

    public function __toString(): string
    {
        return $this->content;
    }

    private function foreach() : void
    {
        if (preg_match_all($this->pattern, $this->content, $matches, PREG_SET_ORDER)) {
            for ($i = 0; $i < count($matches); $i++) {
                $this->match = $matches[$i];
                $this->setForeachBlock();
                $this->setForeachArray();
                $this->setForeachCallback();
                $this->setForeachContent();

                $content  = "<?php foreach({$this->array} as {$this->callback}): ?>";
                /*$content .= "<?php if (is_object({$this->callback})) {$this->callback} = (array) {$this->callback}; ?>";*/
                $content .= $this->foreachContent;
                $content .= "<?php endforeach; ?>";

                $this->content = str_replace($this->block, $content, $this->content);
            };
        }
    }

    private function setForeachBlock() : void
    {
        $this->block = $this->match[0];
    }

    private function setForeachArray() : void
    {
        $explode = explode('.', $this->match[1]);

        $variableArray = '$'.$explode[0];

        for ($i = 1; $i < count($explode); $i++) {
            $variableArray .= "->".$explode[$i];
        }

        $this->array = $variableArray;
    }

    private function setForeachCallback() : void
    {
        $this->callback = '$'.$this->match[2];
    }

    private function setForeachContent() : void
    {
        $this->foreachContent = trim($this->match[3]);
    }
}
