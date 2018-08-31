<?php

namespace Sketch\Tpl\Tag;

class Block extends Tag
{
    public function __construct()
    {
        $this->content();
        $this->default();
    }

    private function content()
    {
        foreach (Tag::$blocks as $blockName => $blockContent) {

            $search = "/{(\s?)+{$blockName}(\s?)+}.*?{(\s?)+\/{$blockName}(\s?)+}/is";

            Tag::match($search, function() use ($blockContent) {
                Tag::replace($blockContent);
                $this->content();
            });
        }
    }

    private function default()
    {
        $search = "/{(\s?)+[\w]+(\s?)+}(.*?){(\s?+)\/[\w]+(\s?)+}/is";

        Tag::match($search, function($content = '') {
            Tag::replace($content);
            $this->default();
        });
    }
}
