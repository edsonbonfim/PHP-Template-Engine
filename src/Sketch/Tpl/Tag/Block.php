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

            $search = "/{(\s?)+blk(\s?)+{$blockName}(\s?)+}.*?{(\s?)+\/blk(\s?)+}/is";

            Tag::match($search, function() use ($blockContent) {
                Tag::replace($blockContent);
                $this->content();
            });
        }
    }

    private function default()
    {
        $search = "/{(\s?)+blk(\s?)+[\w]+(\s?)+}(.*?){(\s?+)\/blk+(\s?)+}/is";

        Tag::match($search, function($content = '') {
            Tag::replace($content);
            $this->default();
        });
    }
}
