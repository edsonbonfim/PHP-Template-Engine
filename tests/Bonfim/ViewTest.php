<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Bonfim\Component\View\View;

class ViewTest extends TestCase
{
    public function testView()
    {
        $test = fopen('tests/Bonfim/test.html', 'w+');
        fwrite($test, 'Test View');
        fclose($test);

        View::config([
            'template_dir' => 'tests/Bonfim'
        ]);

        $this->assertEquals('Test View', View::render('test'));

        unlink('tests/Bonfim/test.html');
    }
}
