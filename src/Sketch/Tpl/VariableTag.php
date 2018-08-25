<?php

namespace Sketch\Tpl;

/**
 * Class VariableTag
 * @package Sketch\Tpl
 */
class VariableTag extends Tag
{
    
    /**
     * @var array
     */
    private $matches = [];
    /**
     * @var string
     */
    private $replace = '';
    /**
     * @var string
     */
    private $variable = '';

    public function __construct()
    {
        parent::__construct('/{\s?([\w]+.?[\w]+.?[\w]+)\s?\|?\s?([\w]+)?\s?}/is');
    }

    public function handle(): string
    {
        $this->getVariable();
        $this->replace = '<?php echo('.$this->variable.'); ?>';
        $this->filter('upper');

        return $this->replace;
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

    /**
     * @param string $name
     */
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
