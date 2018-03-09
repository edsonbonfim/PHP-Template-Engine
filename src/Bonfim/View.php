<?php

namespace Bonfim\Component\View;

class View
{
    private static $view = null;
    private static $data = [];

    private static function view(): Tpl
    {
        if (!isset(self::$view) || is_null(self::$view)) {
            self::$view = new Tpl;
        }

        return self::$view;
    }

    public static function config(array $config): void
    {
        self::view()->config($config);
    }

    public static function assign(string $key, $value): void
    {
        self::$data[$key] = $value;
    }

    public static function render(string $view, array $data = null): string
    {
        return self::view()->render($view, self::$data);
    }
}
