<?php

namespace EdsonOnildo\Tpl\Tag;

use EdsonOnildo\Tpl\Tpl;

class Evaluate extends Tag
{
    public function __construct()
    {
        $this->eval3();
        $this->eval0();
        $this->eval1();
        $this->eval2();
        $this->expression();
        $this->eval4();
    }

    private function eval0(): void
    {
        $search = "/\@{{(\s?)+([\w\.\(\)]+)(\s?)+}}/is";

        Tag::match($search, function($var) {

            Tag::replace("@@ $var @@");
        });
    }

    private function eval4(): void
    {
        $search = "/\@\@(\s?)+([\w\.\(\)]+)(\s?)+\@\@/is";

        Tag::match($search, function($var) {

            Tag::replace("{{ $var }}");
        });
    }

    private function eval1(): void
    {
        $search = "/{{(\s?)+([\w\.\(\)]+)(\s?)+}}/is";

        Tag::match($search, function($var) {

            $var = str_replace('.', '->', $var);

            Tag::replace("<?= \$$var ?>");
        });
    }

    private function eval2(): void
    {
        $search = "/{{(\s?)+([\w\.\(\)]+)(\s?)+\|(\s?)+([\w| ]+)(\s?)+}}/is";

        Tag::match($search, function($var, $filter) {

            $var = str_replace('.', '->', $var);

            $filters = explode('|', $filter);

            $res = "<?= ";
            
            foreach ($filters as $filter) {
                $res .= "$filter(";
            }

            $res .= "$$var";

            foreach ($filters as $filter) {
                $res .= ")";
            }

            $res .= " ?>";

            Tag::replace($res);
        });
    }

    private function eval3(): void
    {
        $search = "/{{(\s?)+([\w]+)(\s?)+\((.*?)\)(\s?)+}}/is";

        Tag::match($search, function($func, $params = '') {

            if (method_exists(__CLASS__, $func)) {
                $func = __CLASS__ . "::$func";
            }

            Tag::replace("<?= $func($params) ?>");
        });
    }

    private function expression(): void
    {
        Tag::match("/{{(\s?)+(.*?)(\s?)+}}/is", function($expr) {
            Tag::replace("<?= $expr ?>");
        });
    }

    public static function style(String $asset): String
    {
        return '<link rel="stylesheet" href="'.Tpl::getUrl().Tpl::getAssets().$asset.'">';
    }

    public static function script(String $asset): String
    {
        return '<script src="'.Tpl::getUrl().Tpl::getAssets().$asset.'"></script>';
    }

    public static function assets(String $asset): String
    {
        return Tpl::getUrl() . Tpl::getAssets() . $asset;
    }

    public static function url(String $url): String
    {
        return Tpl::getUrl();
    }
}
