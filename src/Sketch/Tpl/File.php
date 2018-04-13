<?php

namespace Sketch\Tpl;

class File
{
    private $fname;
    private $file;

    public function __construct(string $fname = null)
    {
        $this->fname = $fname;
    }

    /**
     * @return bool
     */
    public function exists(): bool
    {
        if (file_exists($this->fname)) {
            return true;
        }

        return false;
    }

    /**
     * @return bool|resource
     */
    public function open()
    {
        return $this->file = fopen($this->fname, 'r');
    }

    public function create()
    {
        return $this->file = fopen($this->fname, 'w+');
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

        include $this->fname;

        return ob_get_clean();
    }

    public function close(): void
    {
        fclose($this->file);
    }
}
