<?php

namespace Bonfim\Component\View;

class IncludeTpl extends ForeachTpl
{
    private $file;
    private $pattern = '/{\s?include \'?"?(.*?)"?\'?\s?}/is';

    public function include() : void
    {
        if ($this->matchAll($this->pattern, $this->content)) {
            $this->iterate(function ($i) {
                $this->match = $this->matches[$i];
                $content = file_get_contents("{$this->config['template_dir']}/{$this->match[1]}.html");
                $this->content = str_replace($this->matches[$i][0], $content, $this->content);
            });
        }
    }
}
