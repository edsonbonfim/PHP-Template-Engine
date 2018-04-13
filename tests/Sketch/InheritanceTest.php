<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\Inheritance;

class InheritanceTest extends TestCase
{
    public function testBasicInheritance(): void
    {
        $config = [
            'environment' => 'development',
            'template_dir' => 'tests/Sketch',
            'cache_dir' => 'tests/cache'
        ];

        $expected = "Main layout\nChild block";
        $content  = '{extends \'test\'}';
        $content .= '{block \'content\'}';
        $content .= 'Child block';
        $content .= '{/block}';

        $test = fopen('tests/Sketch/test.html', 'w+');
        fwrite($test, "Main layout\n{block 'content'}{/block}");
        fclose($test);

        $this->assertEquals($expected, (string) new Inheritance($content, $config));

        unlink('tests/Sketch/test.html');
    }
}
