<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\ForeachTpl;

class ForeachTest extends TestCase
{
    public function testBasicForeach(): void
    {
        $expected  = '<?php foreach($users[\'admin\'] as $admin): ?>';
        $expected .= '<p>{admin.name}</p>';
        $expected .= '<?php endforeach; ?>';

        $content  = '{foreach users.admin as admin}';
        $content .= '<p>{admin.name}</p>';
        $content .= '{/foreach}';

        $this->assertEquals($expected, (string) new ForeachTpl($content));
    }
}
