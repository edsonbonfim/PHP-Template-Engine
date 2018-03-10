<?php

namespace Bonfim\Component\View;

trait ElseView
{
    private $elseContent = '';

    private function setElseContent()
    {
        $matches = array();
        if (preg_match('/(.*?){\s?else\s?}/is', $this->match[6], $matches)) {
            $this->ifContent = $matches[1];
            $this->elseContent = str_replace($matches[0], '', $this->match[6]);
        } else {
            $this->ifContent = $this->match[6];
            $this->elseContent = '';
        }
        $this->ifContent = str_replace('{elseif', '{end}{elseif', $this->ifContent);
        $this->ifContent = $this->ifContent . "{end}";
    }

    private function else(): void
    {
        if (!empty($this->elseContent)) {
            $this->replace .= "<?php else: ?>";
            $this->replace .= trim($this->elseContent);
        }
    }
}
