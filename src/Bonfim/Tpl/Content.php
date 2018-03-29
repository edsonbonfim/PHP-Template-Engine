<?php

namespace Bonfim\Tpl;

class Content
{
    public function getContent(string $view, array $config): string
    {
        $file = getcwd() . '/' . $config['template_dir'] . "/$view.html";

        if (!file_exists($file)) {
            throw new \Exception("$file template not found"); // @codeCoverageIgnore
        }

        return $this->removeTags(file_get_contents($file));
    }

    public function removeTags($content)
    {
        return str_replace(array("<?", "?>"), array("&lt;?", "?&gt;"), $content);
    }
}
