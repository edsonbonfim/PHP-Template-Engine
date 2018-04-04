<?php

namespace Sketch\Tpl;

class IncludeTpl
{
    private $content;
    private $config;
    private $pattern = '/{\s?include \'?"?(.*?)"?\'?\s?}/is';

    public function __construct(string $content, array $config)
    {
        $this->config  = $config;
        $this->content = $content;

        $this->include();
    }

    public function __toString(): string
    {
        return $this->content;
    }

    public function include()
    {
        if (preg_match_all($this->pattern, $this->content, $matches, PREG_SET_ORDER)) {
            for ($i = 0; $i < count($matches); $i++) {
                $match = $matches[$i];
                $replace = file_get_contents("{$this->config['template_dir']}/{$match[1]}.html");
                $this->content = str_replace($matches[$i][0], $replace, $this->content);
            };
        }
    }
}
