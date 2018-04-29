<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\Tag;
use Sketch\Tpl\FuncTag;

class FuncTest extends TestCase
{
    public function testBasicFunc()
    {
        $expected = '<?php date(\'Y\'); ?>';
        $content  = '{func date(\'Y\')}';

        Tag::setContent($content);

        new FuncTag();

        $this->assertEquals($expected, Tag::getContent());
    }
}
