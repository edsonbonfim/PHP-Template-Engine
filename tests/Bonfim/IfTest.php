<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Bonfim\Tpl\IfTpl;

class IfTest extends TestCase
{
    public function testBasicIf()
    {
        $expected  = '<?php if($status[\'code\'] === true): ?>';
        $expected .= 'True';
        $expected .= '<?php endif; ?>';

        $content  = '{if status.code === true}';
        $content .= 'True';
        $content .= '{/if}';

        $this->assertEquals($expected, (string) new IfTpl($content));
    }

    public function testIfWithElse()
    {
        $expected  = '<?php if($status === true): ?>';
        $expected .= 'True';
        $expected .= '<?php else: ?>';
        $expected .= 'False';
        $expected .= '<?php endif; ?>';

        $content  = '{if status === true}';
        $content .= 'True';
        $content .= '{else}';
        $content .= 'False';
        $content .= '{/if}';

        $this->assertEquals($expected, (string) new IfTpl($content));
    }

    public function testIfWithElseIf()
    {
        $expected  = '<?php if($status === true): ?>';
        $expected .= 'True';
        $expected .= '<?php elseif($status === 1): ?>';
        $expected .= 'True too';
        $expected .= '<?php endif; ?>';

        $content  = '{if status === true}';
        $content .= 'True';
        $content .= '{elseif status === 1}';
        $content .= 'True too';
        $content .= '{/if}';

        $this->assertEquals($expected, (string) new IfTpl($content));
    }

    public function testIfWithElseIfAndElse()
    {
        $expected  = '<?php if($status === true): ?>';
        $expected .= 'True';
        $expected .= '<?php elseif($status === 1): ?>';
        $expected .= 'True too';
        $expected .= '<?php else: ?>';
        $expected .= 'False';
        $expected .= '<?php endif; ?>';

        $content  = '{if status === true}';
        $content .= 'True';
        $content .= '{elseif status === 1}';
        $content .= 'True too';
        $content .= '{else}';
        $content .= 'False';
        $content .= '{/if}';

        $this->assertEquals($expected, (string) new IfTpl($content));
    }
}
