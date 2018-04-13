<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\IncludeTag;

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

        $this->assertEquals('Test included', (string)new IncludeTag('{include \'test\'}', $config));

        unlink('tests/Sketch/test.html');
    }
}
