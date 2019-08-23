<?php

namespace EdsonOnildo\Tpl\Tag;

use EdsonOnildo\Tpl\Tpl;

class IncludeTag extends Tag
{
    public function __construct()
    {
        Tag::match('/@\s*include\s*\(\s*[\'"](.*?)[\'"]\s*\)/', function($file) {

            $template = str_replace('.', '/', $file);

            $content = file_get_contents(Tpl::getDir() . "$file.php");

            Tag::replace($content);
        });
    }
}
