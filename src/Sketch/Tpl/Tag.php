<?php

namespace Sketch\Tpl;

abstract class Tag
{
    protected static $content;
    protected static $config;

    /**
     * Tag constructor.
     */
    public function __construct()
    {
        $this->handle();
    }

    abstract public function handle();

    public static function setContent(string $content): void
    {
        self::$content = $content;
    }

    public static function getContent(): string
    {
        return self::$content;
    }

    public static function setConfig(array $config): void
    {
        self::$config = $config;
    }

    public static function getConfig(): array
    {
        return self::$config;
    }
}
