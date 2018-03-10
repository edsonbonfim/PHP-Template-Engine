<?php

namespace Bonfim\Component\View;

use Exception;

class VariableTpl
{
    private $pattern = '/{\s?([\w]+.?[\w]+)\s?\|?\s?([\w]+)?\s?}/is';

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
        if (preg_match_all($this->pattern, $this->content, $matches, PREG_SET_ORDER)) {
            for ($i = 0; $i < count($matches); $i++) {
                $explode = explode('.', $matches[$i][1]);

                $variable = $explode[0];

                $variable = '$'.$variable;

                for ($k = 1; $k < count($explode); $k++) {
                    $variable .= "['".$explode[$k]."']";
                }

                $content = '<?php echo('.$variable.'); ?>';

                if (isset($matches[$i][2]) && $matches[$i][2] == 'upper') {
                    $content = '<?php echo(ucwords('.$variable.')); ?>';
                }

                $this->content = str_replace($matches[$i][0], $content, $this->content);
            };
        }
    }
}
