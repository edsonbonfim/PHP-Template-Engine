<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Bonfim\Component\View\VariableTpl;

class VariableTest extends TestCase
{
    public function testBasicVariable()
    {
        $expected = '<?php echo($author[\'name\']); ?>';
        $content  = '{author.name}';

        $this->assertEquals($expected, (string) new VariableTpl($content));
    }
}
