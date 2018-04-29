<?php

namespace Sketch\Tpl;

/**
 * Trait ElseifView
 * @package Sketch\Tpl
 */
trait ElseifView
{
    /**
     * @var array
     */
    private $elseif = array();

    /**
     * @param $condition
     * @return string
     */
    abstract public function setCondition($condition): string;

    private function setElseifContent()
    {
        $pattern = '/{\s?elseif (.*?)\s?([><!=])(=)?(=)?\s?(.*?)\s?}(.*?){end}/is';
        if (preg_match_all($pattern, $this->ifContent, $matches, PREG_SET_ORDER)) {
            $count = count($matches);
            for ($i = 0; $i < $count; $i++) {
                $this->ifContent = str_replace($matches[$i][0], '', $this->ifContent);
                $this->elseif[$i]['firstCondition'] = $this->setCondition($matches[$i][1]);
                $this->elseif[$i]['secondCondition'] = $this->setCondition($matches[$i][5]);
                $this->elseif[$i]['operator'] = implode('', array_slice($matches[$i], 2, 3));
                $this->elseif[$i]['content'] = trim($matches[$i][6]);
            }
        }
        $this->ifContent = str_replace('{end}', '', $this->ifContent);
    }

    private function elseif(): void
    {
        $count = count($this->elseif);
        if ($count != 0) {
            for ($i = 0; $i < $count; $i++) {
                $this->replace .= "<?php elseif({$this->elseif[$i]['firstCondition']}";
                $this->replace .= " {$this->elseif[$i]['operator']}";
                $this->replace .= " {$this->elseif[$i]['secondCondition']}): ?>";
                $this->replace .= trim($this->elseif[$i]['content']);
            }
        }
    }
}
