<?php

namespace Sketch\Tpl;

class RepeatTag extends Tag
{
    public function __construct()
    {
        parent::__construct(
            '/{(\s?)+repeat (\s?)+([\d]+)(\s?)+(:?)(\s?)+([\w]+)?(\s?)+}(.*?){(\s?)+\/repeat(\s?)+}/is'
        );
    }

    public function handle(array $match): string
    {
        static $count = 0;

        if (!empty($match[5]) && empty($match[7])) {
            throw new \Exception("Invalid tag"); // @codeCoverageIgnore
        }

        if (empty($match[5]) && !empty($match[7])) {
            throw new \Exception("Invalid tag"); // @codeCoverageIgnore
        }

        $index = !empty($match[5]) && !empty($match[7])
            ? $match[7]
            : 'index' . ++$count;

        $replace  = "<?php for (\$$index = 0; \$$index < $match[3]; \$$index++) { ?>";
        $replace .= $match[9];
        $replace .= "<?php } ?>";

        return $replace;
    }
}
