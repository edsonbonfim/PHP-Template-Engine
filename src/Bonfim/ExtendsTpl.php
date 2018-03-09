<?php

namespace Bonfim\Component\View;

class ExtendsTpl extends IncludeTpl
{
    private $pattern = '/{\s?extends \'?"?(.*?)"?\'?\s?}/is';

    protected function extends() : void
    {
        if ($this->match($this->pattern)) {
            $this->setContent($this->match[1]);
            $this->replace();
        }
    }

    private function replace() : void
    {
        foreach ($this->blocks as $key => $value) {
            $this->content = preg_replace('/{\s?block \'?"?'.$key.'"?\'?\s?}(.*?){\s?\/block\s?}/is', $value, $this->content);
        }

        $this->content = preg_replace('/{\s?block \'?"?[\w]+"?\'?\s?}/is', '', $this->content);
        $this->content = preg_replace('/{\s?\/block\s?}/is', '', $this->content);
    }
}
