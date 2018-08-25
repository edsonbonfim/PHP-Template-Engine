<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl;

/**
 * Class ViewTest
 * @package Tests
 */
class ViewTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testView()
    {
        $test = fopen('tests/Sketch/test.html', 'w+');
        fwrite($test, 'Welcome {{user.name}} ({{user.email}})!');
        fclose($test);

        Tpl::assign('user', [
            'name' => 'Test',
            'email' => 'test@email.com'
        ]);

        Tpl::config([
            'environment' => 'development',
            'template_dir' => 'tests/Sketch',
            'cache_dir' => 'tests/cache'
        ]);

        $this->assertEquals('Welcome Test (test@email.com)!', Tpl::render('test'));

        unlink('tests/Sketch/test.html');
    }
}
