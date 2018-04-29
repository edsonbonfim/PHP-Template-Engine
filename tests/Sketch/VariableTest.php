<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\{Tag, VariableTag};

class VariableTest extends TestCase
{
    public function testBasicVariable()
    {
        $expected = '<?php echo($author->name); ?>';

        Tag::setContent('{author.name}');

        new VariableTag();

        $this->assertEquals($expected, Tag::getContent());
    }

    public function testFilterUpper()
    {
        $expected = '<?php echo(ucwords(strtolower($name))); ?>';

        Tag::setContent('{name | capitalize}');

        new VariableTag();

        $this->assertEquals($expected, Tag::getContent());
    }
}
