<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Bonfim\Component\View\IncludeTpl;

class IncludeTest extends TestCase
{
    public function testBasicInclude()
    {
        $config = ['template_dir' => 'tests/Bonfim'];

        $test = fopen('tests/Bonfim/test.html', 'w+');
        fwrite($test, 'Test included');
        fclose($test);

        $this->assertEquals('Test included', (string) new IncludeTpl('{include \'test\'}', $config));

        unlink('tests/Bonfim/test.html');
    }
}
