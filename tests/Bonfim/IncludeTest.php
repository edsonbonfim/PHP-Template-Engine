<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\IncludeTpl;

class IncludeTest extends TestCase
{
    public function testBasicInclude()
    {
        $config = [
            'template_dir' => 'tests/Sketch',
            'cache_dir' => 'tests/cache'

        ];

        $test = fopen('tests/Sketch/test.html', 'w+');
        fwrite($test, 'Test included');
        fclose($test);

        $this->assertEquals('Test included', (string) new IncludeTpl('{include \'test\'}', $config));

        unlink('tests/Sketch/test.html');
    }
}
