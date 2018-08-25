<?php

namespace Sketch\Tpl;

/**
 * Class InheritanceTag
 * @package Sketch\Tpl
 */
class InheritanceTag extends Tag
{
    /**
     * @var array
     */
    private $blocks = [];
    
    /**
     * @var string
     */
    private $patternExtends = '/{\s?extends \'?"?(.*?)"?\'?\s?}/is';

    /**
     * InheritanceTag constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        parent::__construct('/{\s?block \'?"?([\w]+)"?\'?\s?}(.*?){\s?\/block\s?}/is');
        $this->extends();
    }

    public function handle(array $match): string
    {
        $this->blocks[$match[1]] = $match[2];
        self::$content = str_replace($this->blocks[$match[1]], '', self::$content);
        return '';
    }

    /**
     * @throws \Exception
     */
    private function extends(): void
    {
        if (preg_match($this->patternExtends, self::$content, $match)) {
            self::$content = Content::getContent($match[1], self::$config);
            $this->replaceTag();
        }
    }

    private function replaceTag(): void
    {
        foreach ($this->blocks as $key => $value) {
            $pattern = '/{\s?block \'?"?' . $key . '"?\'?\s?}(.*?){\s?\/block\s?}/is';
            self::$content = preg_replace($pattern, $value, self::$content);
        }

        self::$content = preg_replace('/{\s?block \'?"?[\w]+"?\'?\s?}/is', '', self::$content);
        self::$content = preg_replace('/{\s?\/block\s?}/is', '', self::$content);
    }
}
