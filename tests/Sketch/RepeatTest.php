<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\RepeatTag;
use Sketch\Tpl\Tag;

class RepeatTest extends TestCase
{
    public function testBasicRepeat(): void
    {
        $expected  = "<ul>";
        $expected .= "<?php for (\$i = 0; \$i < 3; \$i++) { ?>";
        $expected .= "<li>Item</li>";
        $expected .= "<?php } ?>";
        $expected .= "</ul>";

        $content  = "<ul>";
        $content .= "{repeat 3}";
        $content .= "<li>Item</li>";
        $content .= "{/repeat}";
        $content .= "</ul>";

        Tag::setContent($content);

        new RepeatTag();

        $this->assertEquals($expected, Tag::getContent());
    }

    public function testBasicRepeatWithSpaces(): void
    {
        $expected  = "<ul>";
        $expected .= "<?php for (\$i = 0; \$i < 3; \$i++) { ?>";
        $expected .= "<li>Item</li>";
        $expected .= "<?php } ?>";
        $expected .= "</ul>";

        $content  = "<ul>";
        $content .= "{    repeat  3              }";
        $content .= "<li>Item</li>";
        $content .= "{          /repeat    }";
        $content .= "</ul>";

        Tag::setContent($content);

        new RepeatTag();

        $this->assertEquals($expected, Tag::getContent());
    }
}
