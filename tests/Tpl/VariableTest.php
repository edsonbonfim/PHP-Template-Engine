<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\Tag;
use Sketch\Tpl\VariableTag;

/**
 * Class VariableTest
 * @package Tests
 */
class VariableTest extends TestCase
{
    public function testBasicVariable()
    {
        $expected = '<?= $author->name ?>';

        Tag::setContent('{{author.name}}');

        new VariableTag();

        $this->assertEquals($expected, Tag::getContent());
    }

    public function testFilterUpper()
    {
        $expected = '<?= ucwords(strtolower($name)) ?>';

        Tag::setContent('{{name | capitalize}}');

        new VariableTag();

        $this->assertEquals($expected, Tag::getContent());
    }
}
