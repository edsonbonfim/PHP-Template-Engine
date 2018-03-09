<?php

namespace Bonfim\Component\View;

class Tpl extends BlockTpl
{
    public function render(string $view, array $data = []) : string
    {
        $this->view = getcwd() . "/{$this->config['template_dir']}/{$view}.html";
        $this->data = array_merge($data, $this->data);

        $this->setContent($view);
        $this->block();
        $this->extends();
        $this->include();
        $this->foreach();
        $this->if();
        $this->func();
        $this->variable();

        extract($this->data);
        $tmp = tmpfile();

        fwrite($tmp, $this->content);
        fseek($tmp, 0);

        ob_start();
        $file = stream_get_meta_data($tmp);

        include $file['uri'];
        $content = ob_get_clean();
        fclose($tmp);
        return $content;
    }
}
