<?php

namespace EdsonOnildo\Tpl;

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
        if (is_array($value)) {
            $value = json_decode(json_encode($value), false);
        }
        self::$assign[$key] = $value;
    }

    public static function render(string $template): void
    {
        echo self::engine()->render($template, self::$assign);
    }
}
