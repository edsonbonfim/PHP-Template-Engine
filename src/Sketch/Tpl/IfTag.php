<?php

namespace Sketch\Tpl;

/**
 * Class IfTag
 * @package Sketch\Tpl
 */
class IfTag extends Tag
{
    use ElseView;
    use ElseifView;

    /**
     * @var string
     */
    private $pattern = '/{\s?if (.*?)\s?([><!=])(=)?(=)?\s?(.*?)\s?}(.*?){\s?\/if\s?}/is';
    /**
     * @var string
     */
    private $block = '';
    /**
     * @var string
     */
    private $firstCondition = '';
    /**
     * @var string
     */
    private $secondCondition = '';
    /**
     * @var string
     */
    private $operator = '';
    /**
     * @var string
     */
    private $ifContent = '';
    /**
     * @var
     */
    private $replace;
    /**
     * @var
     */
    private $match;

    public function handle(): void
    {
        if (preg_match_all($this->pattern, self::$content, $matches, PREG_SET_ORDER)) {
            for ($i = 0; $i < count($matches); $i++) {
                $this->match = $matches[$i];

                $this->setIfBlock();
                $this->setIfOperator();
                $this->setIfFirstCondition();
                $this->setIfSecondCondition();
                $this->setIfContents();

                $this->if();
                $this->elseif();
                $this->else();
                $this->endif();

                $this->elseif = [];

                self::$content = str_replace($this->block, $this->replace, self::$content);
            }
            new IfTag();
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

    /**
     * @param $condition
     * @return string
     */
    private function setCondition($condition) : string
    {
        if ($this->isVariable($condition)) {
            $explode = explode('.', $condition);

            $condition = '$'.$explode[0];

            for ($i = 1; $i < count($explode); $i++) {
                $condition .= "->".$explode[$i];
            }
        }

        return $condition;
    }

    private function setIfContents()
    {
        $this->setElseContent();
        $this->setElseifContent();
    }

    private function if(): void
    {
        $this->replace  = "<?php if({$this->firstCondition} {$this->operator} {$this->secondCondition}): ?>";
        $this->replace .= trim($this->ifContent);
    }

    private function endif(): void
    {
        $this->replace .= "<?php endif; ?>";
    }

    /**
     * @param $term
     * @return bool
     */
    private function isVariable($term)
    {
        return (is_numeric($term)
        || $this->isStringValue((string) $term)
        || $this->isReservedKey($term)) ? false : true;
    }

    /**
     * @param $key
     * @return bool
     */
    private function isReservedKey($key)
    {
        return ($key == "null" || $key == "true" || $key == "false") ? true : false;
    }

    /**
     * @param string $string
     * @return bool
     */
    private function isStringValue(string $string)
    {
        return (substr($string, 0, 1) == '"' || substr($string, 0, 1) == "'") ? true : false;
    }
}
