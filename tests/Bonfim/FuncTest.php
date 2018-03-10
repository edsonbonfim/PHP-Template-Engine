<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Bonfim\Component\View\FuncTpl;

class FuncTest extends TestCase
{
    public function testBasicFunc()
    {
        $expected = '<?php echo(date(\'Y\')); ?>';
        $content  = '{func date(\'Y\')}';

        $this->assertEquals($expected, (string) new FuncTpl($content));
    }
}
