<?php

namespace Sketch;

use Sketch\Tpl\Engine;

class Tpl
{
    private static $assign = [];
    private static $engine = null;

    /**
     * @return Engine
     */
    private static function engine(): Engine
    {
        if (!isset(self::$engine) || is_null(self::$engine)) {
            self::$engine = new Engine;
        }

        return self::$engine;
    }

    /**
     * @param array $config
     * @throws \Exception
     */
    public static function config(array $config): void
    {
        self::engine()->config($config);
    }

    /**
     * @param string $key
     * @param $value
     */
    public static function assign(string $key, $value): void
    {
        if (is_array($value)) {
            $value = json_decode(json_encode($value), false);
        }

        self::$assign[$key] = $value;
    }

    /**
     * @param string $template
     * @return string
     */
    public static function render(string $template): string
    {
        return self::engine()->render($template, self::$assign);
    }
}
