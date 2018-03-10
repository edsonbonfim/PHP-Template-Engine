<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Bonfim\Component\View\ForeachTpl;

class ForeachTest extends TestCase
{
    public function testBasicForeach(): void
    {
        $expected  = '<?php foreach($authors as $author): ?>';
        $expected .= '<p>{author.name}</p>';
        $expected .= '<?php endforeach; ?>';

        $content  = '{foreach authors as author}';
        $content .= '<p>{author.name}</p>';
        $content .= '{/foreach}';

        $this->assertEquals($expected, (string) new ForeachTpl($content));
    }
}
