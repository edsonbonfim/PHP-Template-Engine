<?php

namespace Sketch\Tpl;

/**
 * Class LoopTag
 * @package Sketch\Tpl
 */
class LoopTag extends Tag
{
    /**
     * @var string
     */
    private $block = '';
    /**
     * @var string
     */
    private $array = '';
    /**
     * @var string
     */
    private $callback = '';
    /**
     * @var string
     */
    private $foreachContent = '';
    /**
     * @var
     */

    public function __construct()
    {
        parent::__construct('/{\s?loop (.*?) as ([\w]+)\s?}(.*?){\s?\/loop\s?}/is');
    }

    public function handle(): void
    {
        $this->setForeachBlock();
        $this->setForeachArray();
        $this->setForeachCallback();
        $this->setForeachContent();

        $content  = "<?php foreach({$this->array} as {$this->callback}): ?>";
        $content .= $this->foreachContent;
        $content .= "<?php endforeach; ?>";

        self::$content = str_replace($this->block, $content, self::$content);
    }

    private function setForeachBlock() : void
    {
        $this->block = $this->match[0];
    }

    private function setForeachArray() : void
    {
        $explode = explode('.', $this->match[1]);

        $variableArray = '$'.$explode[0];

        for ($i = 1; $i < count($explode); $i++) {
            $variableArray .= "->".$explode[$i];
        }

        $this->array = $variableArray;
    }

    private function setForeachCallback() : void
    {
        $this->callback = '$'.$this->match[2];
    }

    private function setForeachContent() : void
    {
        $this->foreachContent = trim($this->match[3]);
    }
}
