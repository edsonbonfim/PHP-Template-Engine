<?php

namespace Sketch\Tpl;

class RepeatTag extends Tag
{
    public function __construct()
    {
        parent::__construct('/{(\s?)+repeat (\s?)+([\d]+)(\s?)+}(.*?){(\s?)+\/repeat(\s?)+}/is');
    }

    public function handle(): string
    {
        $replace  = "<?php for (\$i = 0; \$i < {$this->match[3]}; \$i++) { ?>";
        $replace .= $this->match[5];
        $replace .= "<?php } ?>";

        return $replace;
    }
}
