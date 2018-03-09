<?php

namespace Bonfim\Component\View;

class BlockTpl extends ExtendsTpl
{
    private $pattern = '/{\s?block \'?"?([\w]+)"?\'?\s?}(.*?){\s?\/block\s?}/is';

    public function block() : void
    {
        if ($this->matchAll($this->pattern, $this->content)) {
            $this->iterate(function ($i) {
                $this->blocks[$this->matches[$i][1]] = $this->matches[$i][2];
                $this->content = str_replace($this->blocks[$this->matches[$i][1]]['replace'], '', $this->content);
            });
        }
    }
}
