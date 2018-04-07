<?php

namespace Sketch\Tpl;

use Exception;

class Engine extends Content
{
    private $config;
    private $data = [];

    private $file;
    private $content;

    /**
     * @param array $config
     */
    public function config(array $config): void
    {
        $this->config = $config;
    }

    /**
     * @param string $view
     * @param array $data
     * @return string
     */
    public function render(string $view, array $data = []): string
    {
        try {
            $content = $this->handle($this->getContent($view, $this->config));
        } catch (Exception $e) {
            die($e->getMessage());
        }

        $this->data = array_merge($this->data, $data);

        $fname = getcwd() . '/' . $this->config['cache_dir'] . '/' . $view . '.phtml';

        $file = new File($fname);

        if ($this->config['environment'] == 'production') {
            $file->open();
        } elseif ($this->config['environment'] == 'development') {
            $this->setCache($file, $content);
        }

        $content = $file->read($this->data);

        $file->close();

        return $content;
    }

    public function getContent(string $view, array $config): string
    {
        return parent::getContent($view, $config);
    }

    private function handle($content)
    {
        $content = new Inheritance($content, $this->config);
        $content = new IncludeTpl($content, $this->config);
        $content = new ForeachTpl($content);
        $content = new IfTpl($content);
        $content = new FuncTpl($content);
        $content = new VariableTpl($content);

        return $content;
    }

    private function setCache(File $file, $content): void
    {
        $file->create();
        $file->write($content);
    }
}
