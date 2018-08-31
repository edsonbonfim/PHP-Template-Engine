<?php

namespace Sketch\Tpl\Tag;

class Condition extends Tag
{
    public function __construct()
    {
        $this->elseif();
        $this->else();
        $this->if();
    }

    private function if()
    {
        $search = "/{(\s?)+if(\s?)+([\$\w\.]+)(\s?)+([<>!=]+)(\s?)+([\$\w\d\.\"' ]+)(\s?)+}(.*?){(\s?)+\/if(\s?)+}/is";

        Tag::match($search, function($left, $op, $right, $content = "") {
            
            $left  = str_replace('.', '->', $left);
            $right = str_replace('.', '->', $right);

            $res  = "<?php if ($left $op $right) { ?>";
            $res .= $content;
            $res .= "<?php } ?>";
            
            Tag::replace($res);

            $this->if();
        });
    }

    private function else()
    {
        $search = "/{(\s?)+else(\s?)+}(.*?)/is";

        Tag::match($search, function($content = "") {

            $res  = "<?php } else { ?>";
            $res .= $content;

            Tag::replace($res);

            $this->else();
        });
    }

    private function elseif()
    {
        $search = "/{(\s?)+elseif(\s?)+([\$\w\.]+)(\s?)+([<>!=]+)(\s?)+([\$\w\d\.\"' ]+)(\s?)+}(.*?)/is";

        Tag::match($search, function($left, $op, $right, $content = "") {
            
            $left  = str_replace('.', '->', $left);
            $right = str_replace('.', '->', $right);

            $res  = "<?php } elseif ($left $op $right) { ?>";
            $res .= $content;

            Tag::replace($res);

            $this->elseif();
        });
    }
}
