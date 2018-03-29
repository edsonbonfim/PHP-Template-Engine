<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Bonfim\Tpl\IncludeTpl;

class IncludeTest extends TestCase
{
    public function testBasicInclude()
    {
        $config = [
            'template_dir' => 'tests/Bonfim',
            'cache_dir' => 'tests/cache'

        ];

        $test = fopen('tests/Bonfim/test.html', 'w+');
        fwrite($test, 'Test included');
        fclose($test);

        $this->assertEquals('Test included', (string) new IncludeTpl('{include \'test\'}', $config));

        unlink('tests/Bonfim/test.html');
    }
}
