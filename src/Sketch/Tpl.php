<?php

namespace Sketch;

use Sketch\Tpl\Engine;

class Tpl
{
    private static $assign = [];
    private static $engine = null;

    private static function engine(): Engine
    {
        if (!isset(self::$engine) || is_null(self::$engine)) {
            self::$engine = new Engine;
        }

        return self::$engine;
    }

    public static function config(array $config): void
    {
        self::engine()->config($config);
    }

    public static function assign(string $key, $value): void
    {
        self::$assign[$key] = $value;
    }

    public static function render(string $template): string
    {
        return self::engine()->render($template, self::$assign);
    }
}
