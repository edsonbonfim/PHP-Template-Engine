<?php

namespace Bonfim\Component\View;

abstract class ParseTpl
{
    protected $match = array();
    protected $matches = array();
    protected $blocks  = array();
    protected $content = '';
    protected $config = array();
    protected $data = array(
        '__version' => '1.0.0'
    );
    protected $view = '';

    public function match(string $pattern) : int
    {
        return preg_match($pattern, $this->content, $this->match);
    }

    public function matchAll(string $pattern, string $subject) : int
    {
        return preg_match_all($pattern, $subject, $this->matches, PREG_SET_ORDER);
    }

    public function iterate($callback) : void
    {
        for ($i = 0; $i < count($this->matches); $i++) {
            $callback($i);
        }
    }

    public function config(array $config)
    {
        $this->config = $config;
    }

    public function setContent($view) : void
    {
        $file = getcwd() . '/' . $this->config['template_dir'] . "/$view.html";

        if (!file_exists($file)) {
            throw new \Exception("$file template not found");
        }

        $this->content = $this->removeTags(file_get_contents($file));
    }

    public function removeTags($content)
    {
        return str_replace(array("<?", "?>"), array("&lt;?", "?&gt;"), $content);
    }

    public function getContent() : string
    {
        return $this->content;
    }
}
