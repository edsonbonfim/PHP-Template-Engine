<?php

namespace EdsonOnildo\Tpl;

class Content
{
    public static function getContent(string $view, array $config): string
    {
        $file = getcwd() . '/' . $config['template_dir'] . "/$view.html";

        if (!file_exists($file)) {
            throw new \Exception("$file template not found"); // @codeCoverageIgnore
        }

        return self::removeTags(file_get_contents($file));
    }

    public static function removeTags($content)
    {
        return str_replace(array("<?", "?>"), array("&lt;?", "?&gt;"), $content);
    }
}
