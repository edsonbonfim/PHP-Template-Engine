<?php

namespace Sketch\Tpl\Tag;

class Buttons extends Tag
{
    public function __construct()
    {
        $this->btnDefault();
        $this->btnCustom();
    }

    private function btnDefault()
    {
        $regex = "/{(\s?)+btn(\s?)+}(.*?){(\s?)+\/btn(\s?)+}/is";

        Tag::match($regex, function($value = "") {

            Tag::replace("<button class=\"btn\">$value</button>");
        });
    }

    private function btnCustom()
    {
        $regex = "/{(\s?)+btn(\s?)+[\"'](.*?)[\"'](\s?)+}(.*?){(\s?)+\/btn(\s?)+}/is";

        Tag::match($regex, function($class = "", $value = "") {

            Tag::replace("<button class=\"btn btn-$class\">$value</button>");
        });
    }
}
