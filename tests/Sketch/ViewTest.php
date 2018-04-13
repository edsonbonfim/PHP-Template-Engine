<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl;

class ViewTest extends TestCase
{
    public function testView()
    {
        $test = fopen('tests/Sketch/test.html', 'w+');
        fwrite($test, '{title}');
        fclose($test);

        Tpl::assign('title', 'Test View');

        Tpl::config([
            'environment' => 'development',
            'template_dir' => 'tests/Sketch',
            'cache_dir' => 'tests/cache'
        ]);

        $this->assertEquals('Test View', Tpl::render('test'));

        unlink('tests/Sketch/test.html');
    }
}
