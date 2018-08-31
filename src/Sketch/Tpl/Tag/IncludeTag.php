<?php

namespace Sketch\Tpl\Tag;

class IncludeTag extends Tag
{
    public function __construct()
    {
        $search = "/{(\s?)+include(\s?)+[\"']([\w\.]+)[\"'](\s?)+}/is";

        Tag::match($search, function($template) {

            $template = str_replace('.', '/', $template);

            $path    = self::$config['template_dir'];
            $content = file_get_contents("$path/$template.html");

            Tag::replace($content);
        });
    }
}
