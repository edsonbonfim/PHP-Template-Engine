<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Bonfim\Tpl\VariableTpl;

class VariableTest extends TestCase
{
    public function testBasicVariable()
    {
        $expected = '<?php echo($author[\'name\']); ?>';
        $content  = '{author.name}';

        $this->assertEquals($expected, (string) new VariableTpl($content));
    }

    public function testFilterUpper()
    {
        $expected = '<?php echo(ucwords($name)); ?>';
        $content  = '{name | upper}';

        $this->assertEquals($expected, (string) new VariableTpl($content));
    }
}
