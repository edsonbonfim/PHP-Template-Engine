<?php

namespace EdsonOnildo\Tpl;

use EdsonOnildo\Tpl\Tag\Tag;

class Engine
{
    private $data = [];

    public function render(string $view, array $data = []): string
    {
        try {
            $content = $this->handle(Content::getContent($view));
        } catch (Exception $e) { // @codeCoverageIgnore
            return $e->getMessage(); // @codeCoverageIgnore
        }

        $this->data = array_merge($this->data, $data);

        if (!array_key_exists('page', $this->data)) {
            $this->data['page'] = $_SERVER['REQUEST_URI'];
        }

        $dir = Tpl::getDir() . '.cache/';

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $fname = $dir . md5($view) . '.phtml';

        $file = new File($fname);

        $this->setCache($file, $content);

        $content = $file->read($this->data);

        $file->close();

        return trim($content);
    }

    private function handle($content)
    {
        Tag::setContent($content);

        $this->registerTag([
            'Inheritance',
            'Block',
            'IncludeTag',
//            'Statement',
            'Evaluate',
            // 'Func',
            'Loop',
            'Condition',
            // 'Expression'
        ]);

        return Tag::getContent();
    }

    private function setCache(File $file, $content): void
    {
        $file->create();
        $file->write($content);
    }

    private function registerTag(array $tags): void
    {
        foreach ($tags as $tag) {
            $tag = "\EdsonOnildo\Tpl\Tag\\" . ucfirst($tag);
            new $tag;
        }
    }
}
