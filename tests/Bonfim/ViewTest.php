<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Bonfim\Tpl;

class ViewTest extends TestCase
{
    public function testView()
    {
        $test = fopen('tests/Bonfim/test.html', 'w+');
        fwrite($test, '{title}');
        fclose($test);

        Tpl::assign('title', 'Test View');

        Tpl::config([
            'template_dir' => 'tests/Bonfim',
            'cache_dir' => 'tests/cache'
        ]);

        $this->assertEquals('Test View', Tpl::render('test'));

        unlink('tests/Bonfim/test.html');
    }
}
