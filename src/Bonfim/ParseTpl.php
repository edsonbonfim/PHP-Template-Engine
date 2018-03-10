<?php

namespace Bonfim\Component\View;

trait ParseTpl
{
    protected $config = array();
    protected $data = array(
        '__version' => '1.0.0'
    );
    protected $view = '';

    public function config(array $config)
    {
        $this->config = $config;
    }

    public function getContent($view): string
    {
        $file = getcwd() . '/' . $this->config['template_dir'] . "/$view.html";

        if (!file_exists($file)) {
            throw new \Exception("$file template not found");
        }

        return $this->removeTags(file_get_contents($file));
    }

    public function removeTags($content)
    {
        return str_replace(array("<?", "?>"), array("&lt;?", "?&gt;"), $content);
    }
}
