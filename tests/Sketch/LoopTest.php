<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\LoopTag;
use Sketch\Tpl\Tag;

/**
 * Class LoopTest
 * @package Tests
 */
class LoopTest extends TestCase
{
    public function testBasicForeach(): void
    {
        $expected  = '<?php foreach($users->admin as $admin): ?>';
        $expected .= '<p>{admin.name}</p>';
        $expected .= '<?php endforeach; ?>';

        $content  = '{loop users.admin as admin}';
        $content .= '<p>{admin.name}</p>';
        $content .= '{/loop}';

        Tag::setContent($content);

        new LoopTag();

        $this->assertEquals($expected, Tag::getContent());
    }
}
