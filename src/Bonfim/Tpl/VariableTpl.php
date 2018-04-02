<?php

namespace Bonfim\Tpl;

use Exception;

class VariableTpl
{
    private $pattern = '/{\s?([\w]+.?[\w]+.?[\w]+)\s?\|?\s?([\w]+)?\s?}/is';
    private $match   = [];
    private $matches = [];
    private $replace = '';
    private $variable = '';

    public function __construct(string $content)
    {
        $this->content = $content;
        $this->variable();
    }

    public function __toString(): string
    {
        return $this->content;
    }

    private function variable(): void
    {
        if (preg_match_all($this->pattern, $this->content, $this->matches, PREG_SET_ORDER)) {
            for ($i = 0; $i < count($this->matches); $i++) {
                $this->match = $this->matches[$i];
                $this->getVariable();
                /*$this->replace = "<?php if (is_object({$this->variable})) {$this->variable} = (array) {$this->variable}; ?>";*/
                $this->replace = '<?php echo('.$this->variable.'); ?>';
                $this->filter('upper');
                $this->content = str_replace($this->match[0], $this->replace, $this->content);
            };
        }
    }

    private function getVariable(): void
    {
        $explode = explode('.', $this->match[1]);

        $variable = $explode[0];

        $variable = '$'.$variable;

        for ($k = 1; $k < count($explode); $k++) {
            $variable .= "->".$explode[$k];
        }

        $this->variable = $variable;
    }

    private function filter(string $name): void
    {
        $this->$name();
    }

    private function upper(): void
    {
        if (isset($this->match[2]) && $this->match[2] == 'capitalize') {
            $this->replace = '<?php echo(ucwords(strtolower('.$this->variable.'))); ?>';
        }
    }
}
