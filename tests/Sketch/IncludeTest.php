<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\{Tag, IncludeTag};

class IncludeTest extends TestCase
{
    public function testBasicInclude()
    {
        $config = [
            'environment' => 'development',
            'template_dir' => 'tests/Sketch',
            'cache_dir' => 'tests/cache'

        ];

        $test = fopen('tests/Sketch/test.html', 'w+');
        fwrite($test, 'Test included');
        fclose($test);

        Tag::setConfig($config);
        Tag::setContent('{include \'test\'}');

        new IncludeTag();

        $this->assertEquals('Test included', Tag::getContent());

        unlink('tests/Sketch/test.html');
    }
}
