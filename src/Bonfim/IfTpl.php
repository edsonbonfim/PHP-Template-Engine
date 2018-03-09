<?php

namespace Bonfim\Component\View;

class IfTpl extends FuncTpl
{
    private $pattern = '/{\s?if (.*?)\s?([><!=])(=)?(=)?\s?(.*?)\s?}(.*?){\s?\/if\s?}/is';
    private $block = '';
    private $firstCondition = '';
    private $secondCondition = '';
    private $operator = '';
    private $elseif = array();
    private $ifConten = '';
    private $elseContent = '';

    public function if() : void
    {
        if ($this->matchAll($this->pattern, $this->content)) {
            for ($i = 0; $i < count($this->matches); $i++) {
                $this->match = $this->matches[$i];

                $this->setBlock();
                $this->setOperator();
                $this->setFirstCondition();
                $this->setSecondCondition();
                $this->setContents();

                $content  = "<?php if({$this->firstCondition} {$this->operator} {$this->secondCondition}): ?>";
                $content .= trim($this->ifConten);


                if (count($this->elseif) != 0) {
                    for ($k = 0; $k < count($this->elseif); $k++) {
                        $content .= "<?php elseif({$this->elseif[$k]['firstCondition']} {$this->elseif[$k]['operator']} {$this->elseif[$k]['secondCondition']}): ?>";
                        $content .= trim($this->elseif[$k]['content']);
                    }
                }

                if (!empty($this->elseContent)) {
                    $content .= "<?php else: ?>";
                    $content .= trim($this->elseContent);
                }

                $content .= "<?php endif; ?>";

                $this->content = str_replace($this->block, $content, $this->content);
            }
            $this->if();
        }
    }

    private function setBlock() : void
    {
        $this->block = $this->match[0];
    }

    private function setOperator() : void
    {
        $this->operator = implode('', array_slice($this->match, 2, 3));
    }

    private function setFirstCondition() : void
    {
        $this->firstCondition = $this->setCondition($this->match[1]);
    }

    private function setSecondCondition() : void
    {
        $this->secondCondition = $this->setCondition($this->match[5]);
    }

    private function setCondition($condition) : string
    {
        if ($this->isVariable($condition)) {
            $explode = explode('.', $condition);

            $condition = '$'.$explode[0];

            for ($i = 1; $i < count($explode); $i++) {
                $condition .= "['".$explode[$i]."']";
            }
        }

        return $condition;
    }

    private function setContents()
    {
        $this->setElseContent();
        $this->setElseifContent();
    }

    private function setElseContent()
    {
        $matches = array();
        if (preg_match('/(.*?){\s?else\s?}/is', $this->match[6], $matches)) {
            $this->ifConten = $matches[1];
            $this->elseContent = str_replace($matches[0], '', $this->match[6]);
        } else {
            $this->ifConten = $this->match[6];
            $this->elseContent = '';
        }
        $this->ifConten = str_replace('{elseif', '{end}{elseif', $this->ifConten);
        $this->ifConten = $this->ifConten . "{end}";
    }

    private function setElseifContent()
    {
        $matches = array();
        if (preg_match_all('/{\s?elseif (.*?)\s?([><!=])(=)?(=)?\s?(.*?)\s?}(.*?){end}/is', $this->ifConten, $matches, PREG_SET_ORDER)) {
            for ($i = 0; $i < count($matches); $i++) {
                $this->ifConten = str_replace($matches[$i][0], '', $this->ifConten);
                $this->elseif[$i]['firstCondition'] = $this->setCondition($matches[$i][1]);
                $this->elseif[$i]['secondCondition'] = $this->setCondition($matches[$i][5]);
                $this->elseif[$i]['operator'] = implode('', array_slice($matches[$i], 2, 3));
                $this->elseif[$i]['content'] = trim($matches[$i][6]);
            }
        }
        $this->ifConten = str_replace('{end}', '', $this->ifConten);
    }

    private function isVariable(mixed $term)
    {
        return (is_numeric($term) || $this->isStringValue((string) $term) || $this->isReservedKey($term)) ? false : true;
    }

    private function isReservedKey(mixed $key)
    {
        return ($key == "null" || $key == "true" || $key == "false") ? true : false;
    }

    private function isStringValue(string $string)
    {
        return (substr($string, 0, 1) == '"' || substr($string, 0, 1) == "'") ? true : false;
    }
}
