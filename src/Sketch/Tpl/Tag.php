<?php

namespace Sketch\Tpl;

/**
 * Class Tag
 * @package Sketch\Tpl
 */
abstract class Tag
{
    /**
     * @var
     */
    protected static $content;
    
    /**
     * @var
     */
    protected static $config;

    protected $match = [];

    /**
     * Tag constructor.
     */
    public function __construct(string $pattern)
    {
        if (preg_match_all($pattern, self::getContent(), $matches, PREG_SET_ORDER)) {
            $count = count($matches);
            for ($i = 0; $i < $count; $i++) {
                $this->match = $matches[$i];
                $this->replace($this->handle());
            }
        }
    }

    /**
     * @return mixed
     */
    abstract public function handle(): string;

    protected function replace(string $replace): void
    {
        self::setContent(str_replace($this->match[0], $replace, self::getContent()));
    }

    /**
     * @param string $content
     */
    public static function setContent(string $content): void
    {
        self::$content = $content;
    }

    /**
     * @return string
     */
    public static function getContent(): string
    {
        return self::$content;
    }

    /**
     * @param array $config
     */
    public static function setConfig(array $config): void
    {
        self::$config = $config;
    }

    /**
     * @return array
     */
    public static function getConfig(): array
    {
        return self::$config;
    }
}
