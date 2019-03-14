<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\EvalTag;
use Sketch\Tpl\Tag;

class EvalTest extends TestCase
{
    public function testSun()
    {
        $expected = "<?php \$num = \$num1 + \$num2 ?>";
        $content  = "{num = \$num1 + \$num2}";

        Tag::setContent($content);

        new EvalTag();

        $this->assertEquals($expected, Tag::getContent());
    }

    public function testExpr()
    {
        $expected = "<?php \$expr = \$a + \$b * 3 / (2 + \$c) ^ 2 ?>";
        $content  = "{expr = \$a + \$b * 3 / (2 + \$c) ^ 2}";

        Tag::setContent($content);

        new EvalTag();

        $this->assertEquals($expected, Tag::getContent());
    }
}
