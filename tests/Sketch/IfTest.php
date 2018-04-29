<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\Tag;
use Sketch\Tpl\IfTag;

/**
 * Class IfTest
 * @package Tests
 */
class IfTest extends TestCase
{
    public function testBasicIf()
    {
        $expected  = '<?php if($status->code === true): ?>';
        $expected .= 'True';
        $expected .= '<?php endif; ?>';

        $content  = '{if status.code === true}';
        $content .= 'True';
        $content .= '{/if}';

        Tag::setContent($content);

        new IfTag();

        $this->assertEquals($expected, Tag::getContent());
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

        Tag::setContent($content);

        new IfTag();

        $this->assertEquals($expected, Tag::getContent());
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

        Tag::setContent($content);

        new IfTag();

        $this->assertEquals($expected, Tag::getContent());
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

        Tag::setContent($content);

        new IfTag();

        $this->assertEquals($expected, Tag::getContent());
    }
}
