<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\RepeatTag;
use Sketch\Tpl\VariableTag;
use Sketch\Tpl\Tag;

class RepeatTest extends TestCase
{
    public function testBasicRepeat(): void
    {
        $expected  = "<ul>";
        $expected .= "<?php for (\$index1 = 0; \$index1 < 3; \$index1++) { ?>";
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
        $expected .= "<?php for (\$index2 = 0; \$index2 < 3; \$index2++) { ?>";
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

    public function testRepeatWithVariable()
    {
        $expected  = "<ul>";
        $expected .= "<?php for (\$item = 0; \$item < 3; \$item++) { ?>";
        $expected .= "<li>Item <?= \$item ?></li>";
        $expected .= "<?php } ?>";
        $expected .= "</ul>";

        $content  = "<ul>";
        $content .= "{repeat 3 : item}";
        $content .= "<li>Item {{item}}</li>";
        $content .= "{/repeat}";
        $content .= "</ul>";

        Tag::setContent($content);

        new RepeatTag();
        new VariableTag();

        $this->assertEquals($expected, Tag::getContent());
    }

    public function testRepeatWithRepeat()
    {
        $expected  = "<?php for (\$i = 0; \$i < 192; \$i++) { ?>";
        $expected .= "<?php for (\$k = 0; \$k < 214; \$k++) { ?>";
        $expected .= "k = <?= \$k ?>";
        $expected .= "<?php } ?>";
        $expected .= "i = <?= \$i ?>";
        $expected .= "<?php } ?>";

        $content  = "{repeat 192 : i}";
        $content .= "{repeat 214 : k}";
        $content .= "k = {{k}}";
        $content .= "{/repeat}";
        $content .= "i = {{i}}";
        $content .= "{/repeat}";

        Tag::setContent($content);

        new RepeatTag();
        new VariableTag();

        $this->assertEquals($expected, Tag::getContent());
    }
}
