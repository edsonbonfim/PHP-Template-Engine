<?php

namespace EdsonOnildo\Tpl;

class Content
{
    public static function getContent(string $view): string
    {
        $view = str_replace('.', '/', $view);
        $file = Tpl::getDir() . "$view.php";

        if (!file_exists($file)) {
            throw new \Exception("$file template not found"); // @codeCoverageIgnore
        }

        return file_get_contents($file);
    }
}
