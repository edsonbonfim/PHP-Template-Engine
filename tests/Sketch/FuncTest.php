<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\FuncTag;

class FuncTest extends TestCase
{
    public function testBasicFunc()
    {
        $expected = '<?php date(\'Y\'); ?>';
        $content  = '{func date(\'Y\')}';

        $this->assertEquals($expected, (string)new FuncTag($content));
    }
}
