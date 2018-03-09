<?php

namespace Bonfim\Component\View;

use Exception;

class VariableTpl extends ParseTpl
{
    public function variable() : void
    {
        if ($this->matchAll('/{\s?([\w]+.?[\w]+)\s?\|?\s?([\w]+)?\s?}/is', $this->content)) {
            $this->iterate(function ($i) {
                $explode = explode('.', $this->matches[$i][1]);

                $variable = $explode[0];

                if (!array_key_exists($variable, $this->data)) {
                    throw new Exception("Undefined variable: {$variable} in {$this->view}", 1);
                }

                $variable = '$'.$variable;

                for ($k = 1; $k < count($explode); $k++) {
                    $variable .= "['".$explode[$k]."']";
                }

                $content = '<?php echo('.$variable.'); ?>';

                if ($this->matches[$i][2] == 'upper') {
                    $content = '<?php echo(ucwords('.$variable.')); ?>';
                }

                $this->content = str_replace($this->matches[$i][0], $content, $this->content);
            });
        }
    }
}
