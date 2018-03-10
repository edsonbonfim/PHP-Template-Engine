<?php

namespace Bonfim\Component\View;

class Inheritance
{
    use ParseTpl;

    private $blocks = [];
    private $content = '';
    private $patternBlock   = '/{\s?block \'?"?([\w]+)"?\'?\s?}(.*?){\s?\/block\s?}/is';
    private $patternExtends = '/{\s?extends \'?"?(.*?)"?\'?\s?}/is';

    public function __construct(string $content, array $config)
    {
        $this->config = $config;
        $this->content = $content;
        $this->block();
        $this->extends();
    }

    public function __toString(): string
    {
        return $this->content;
    }

    private function block(): void
    {
        if (preg_match_all($this->patternBlock, $this->content, $matches, PREG_SET_ORDER)) {
            for ($i = 0; $i < count($matches); $i++) {
                $this->blocks[$matches[$i][1]] = $matches[$i][2];
                $this->content = str_replace($this->blocks[$matches[$i][1]], '', $this->content);
            };
        }
    }

    private function extends(): void
    {
        if (preg_match($this->patternExtends, $this->content, $match)) {
            $this->content = $this->getContent($match[1]);
            $this->replace();
        }
    }

    private function replace(): void
    {
        foreach ($this->blocks as $key => $value) {
            $this->content = preg_replace('/{\s?block \'?"?'.$key.'"?\'?\s?}(.*?){\s?\/block\s?}/is', $value, $this->content);
        }

        $this->content = preg_replace('/{\s?block \'?"?[\w]+"?\'?\s?}/is', '', $this->content);
        $this->content = preg_replace('/{\s?\/block\s?}/is', '', $this->content);
    }
}
