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
            for ($i = 0; $i < count($matches); $i++) {
                $this->match = $matches[$i];
                $this->handle();
            }
            $this->handle();
        }
    }

    /**
     * @return mixed
     */
    abstract public function handle();

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
