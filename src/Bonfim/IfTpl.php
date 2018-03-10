<?php

namespace Bonfim\Component\View;

class IfTpl
{
    private $pattern = '/{\s?if (.*?)\s?([><!=])(=)?(=)?\s?(.*?)\s?}(.*?){\s?\/if\s?}/is';
    private $block = '';
    private $firstCondition = '';
    private $secondCondition = '';
    private $operator = '';
    private $elseif = array();
    private $ifConten = '';
    private $elseContent = '';
    private $content;
    private $match;

    public function __construct(string $content)
    {
        $this->content = $content;
        $this->if();
    }

    public function __toString(): string
    {
        return $this->content;
    }

    private function if() : void
    {
        if (preg_match_all($this->pattern, $this->content, $matches, PREG_SET_ORDER)) {
            for ($i = 0; $i < count($matches); $i++) {
                $this->match = $matches[$i];

                $this->setIfBlock();
                $this->setIfOperator();
                $this->setIfFirstCondition();
                $this->setIfSecondCondition();
                $this->setIfContents();

                $content  = "<?php if({$this->firstCondition} {$this->operator} {$this->secondCondition}): ?>";
                $content .= trim($this->ifConten);


                if (count($this->elseif) != 0) {
                    for ($k = 0; $k < count($this->elseif); $k++) {
                        $content .= "<?php elseif({$this->elseif[$k]['firstCondition']}";
                        $content .= " {$this->elseif[$k]['operator']}";
                        $content .= " {$this->elseif[$k]['secondCondition']}): ?>";
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

    private function setIfBlock() : void
    {
        $this->block = $this->match[0];
    }

    private function setIfOperator() : void
    {
        $this->operator = implode('', array_slice($this->match, 2, 3));
    }

    private function setIfFirstCondition() : void
    {
        $this->firstCondition = $this->setCondition($this->match[1]);
    }

    private function setIfSecondCondition() : void
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

    private function setIfContents()
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
        $pattern = '/{\s?elseif (.*?)\s?([><!=])(=)?(=)?\s?(.*?)\s?}(.*?){end}/is';
        if (preg_match_all($pattern, $this->ifConten, $matches, PREG_SET_ORDER)) {
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

    private function isVariable($term)
    {
        return (is_numeric($term)
        || $this->isStringValue((string) $term)
        || $this->isReservedKey($term)) ? false : true;
    }

    private function isReservedKey($key)
    {
        return ($key == "null" || $key == "true" || $key == "false") ? true : false;
    }

    private function isStringValue(string $string)
    {
        return (substr($string, 0, 1) == '"' || substr($string, 0, 1) == "'") ? true : false;
    }
}
