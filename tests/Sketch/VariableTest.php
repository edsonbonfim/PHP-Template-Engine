<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\VariableTag;

class VariableTest extends TestCase
{
    public function testBasicVariable()
    {
        $expected = '<?php echo($author->name); ?>';
        $content  = '{author.name}';

        $this->assertEquals($expected, (string)new VariableTag($content));
    }

    public function testFilterUpper()
    {
        $expected = '<?php echo(ucwords(strtolower($name))); ?>';
        $content  = '{name | capitalize}';

        $this->assertEquals($expected, (string)new VariableTag($content));
    }
}
