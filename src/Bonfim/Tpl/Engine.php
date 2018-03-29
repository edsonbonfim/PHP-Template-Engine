<?php

namespace Bonfim\Tpl;

class Engine extends Content
{
    private $config;
    private $data = ['__version' => '1.1.0'];

    public function config(array $config): void
    {
        $this->config = $config;
    }

    public function render(string $view, array $data = []): string
    {
        $content = $this->handle($this->getContent($view, $this->config));

        $this->data = array_merge($data, $this->data);

        $fname = getcwd() . '/' . $this->config['cache_dir'] . '/' . $view . '.phtml';

        $file = new File;

        if ($file->create($fname) !== false) {
            $file->write($content);
            $content = $file->read($this->data);
            $file->close();
        }

        return $content;
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
}
