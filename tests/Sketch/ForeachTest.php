<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\LoopTag;
use Sketch\Tpl\Tag;

/**
 * Class ForeachTest
 * @package Tests
 */
class ForeachTest extends TestCase
{
    public function testBasicForeach(): void
    {
        $expected  = '<?php foreach($users->admin as $admin): ?>';
        $expected .= '<p>{admin.name}</p>';
        $expected .= '<?php endforeach; ?>';

        $content  = '{foreach users.admin as admin}';
        $content .= '<p>{admin.name}</p>';
        $content .= '{/foreach}';

        Tag::setContent($content);

        new LoopTag();

        $this->assertEquals($expected, Tag::getContent());
    }
}
