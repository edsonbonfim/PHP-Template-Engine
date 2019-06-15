<?php

namespace EdsonOnildo\Tpl\Tag;

use EdsonOnildo\Tpl\Tpl;

class IncludeTag extends Tag
{
    public function __construct()
    {
        $search = "/@(\s?)+include(\s?)+([\w\.]+)/is";

        Tag::match($search, function($template) {

            $template = str_replace('.', '/', $template);

            $content = file_get_contents(Tpl::getDir() . "$template.php");

            Tag::replace($content);
        });
    }
}
