<?php

namespace Bonfim\Tpl;

class File
{
    private $name;
    private $file;

    public function create(string $name)
    {
        $this->name = $name;
        $this->file = fopen($name, 'w+');

        return $this->file;
    }

    public function write(string $content): void
    {
        fwrite($this->file, $content);
        fseek($this->file, 0);
    }

    public function read(array $data): string
    {
        extract($data);

        ob_start();

        include $this->name;

        return ob_get_clean();
    }

    public function close(): void
    {
        fclose($this->file);
    }
}
