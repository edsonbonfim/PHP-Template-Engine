<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\Tag;
use Sketch\Tpl\InheritanceTag;

class InheritanceTest extends TestCase
{
    /**
     * @throws \Exception
     */
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

        Tag::setConfig($config);
        Tag::setContent($content);

        new InheritanceTag();

        $this->assertEquals($expected, Tag::getContent());

        unlink('tests/Sketch/test.html');
    }
}
