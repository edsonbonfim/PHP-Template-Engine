<?php

namespace Bonfim\Component\View;

class Tpl
{
    use ParseTpl;

    public function render(string $view, array $data = []) : string
    {
        $content = $this->getContent($view);
        $content = new Inheritance($content, $this->config);
        $content = new IncludeTpl($content, $this->config);
        $content = new ForeachTpl($content);
        $content = new IfTpl($content);
        $content = new FuncTpl($content);
        $content = new VariableTpl($content);


        $this->data = array_merge($data, $this->data);
        extract($this->data);

        $tmp = tmpfile();

        if ($tmp !== false) {
            fwrite($tmp, $content);
            fseek($tmp, 0);

            ob_start();
            $file = stream_get_meta_data($tmp);

            include $file['uri'];
            $content = ob_get_clean();
            fclose($tmp);
        }
        return $content;
    }
}
