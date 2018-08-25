<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use Sketch\Tpl\File;

class FileTest extends TestCase
{
    public $file;

    public function SetUp()
    {
        $this->file = new File('test.txt');
    }

    public function testCreateFile()
    {
        if (!$this->file->exists()) {
            $this->file->create();
        }

        $this->assertEquals(file_exists('test.txt'), true);
    }

    public function testOpenFile()
    {
        if ($this->file->exists()) {
            $this->file->open();
        }

        $this->assertEquals(file_get_contents('test.txt'), '');

        \unlink('test.txt');
    }
}
