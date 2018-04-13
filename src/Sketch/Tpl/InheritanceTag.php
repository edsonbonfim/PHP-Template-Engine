<?php

namespace Sketch\Tpl;

class InheritanceTag extends Tag
{
    private $blocks = [];
    private $patternBlock = '/{\s?block \'?"?([\w]+)"?\'?\s?}(.*?){\s?\/block\s?}/is';
    private $patternExtends = '/{\s?extends \'?"?(.*?)"?\'?\s?}/is';

    public function __construct()
    {
        parent::__construct();
        $this->extends();
    }

    private function extends(): void
    {
        if (preg_match($this->patternExtends, self::$content, $match)) {
            self::$content = Content::getContent($match[1], self::$config);
            $this->replace();
        }
    }

    private function replace(): void
    {
        foreach ($this->blocks as $key => $value) {
            $pattern = '/{\s?block \'?"?' . $key . '"?\'?\s?}(.*?){\s?\/block\s?}/is';
            self::$content = preg_replace($pattern, $value, self::$content);
        }

        self::$content = preg_replace('/{\s?block \'?"?[\w]+"?\'?\s?}/is', '', self::$content);
        self::$content = preg_replace('/{\s?\/block\s?}/is', '', self::$content);
    }

    public function handle(): void
    {
        if (preg_match_all($this->patternBlock, self::$content, $matches, PREG_SET_ORDER)) {
            for ($i = 0; $i < count($matches); $i++) {
                $this->blocks[$matches[$i][1]] = $matches[$i][2];
                self::$content = str_replace($this->blocks[$matches[$i][1]], '', self::$content);
            };
        }
    }
}
