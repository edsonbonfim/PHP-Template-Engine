<?php

namespace EdsonOnildo\Tpl;

use EdsonOnildo\Tpl\Tag\Tag;
use Exception;

class Engine
{
    private $data = [];

    public function config($config): void
    {
        $expected = ['dev', 'template_dir', 'cache_dir'];

        foreach ($expected as $exp) {
            if (count($config) == 3) {
                if (!array_key_exists($exp, $config)) {
                    throw new Exception("The $exp configuration is expected");
                }
            } else {
                throw new Exception("The configuration expected only tree arguments");
            }
        }

        Tag::setConfig($config);
    }

    public function render(string $view, array $data = []): string
    {
        try {
            $content = $this->handle(Content::getContent($view, Tag::getConfig()));
        } catch (Exception $e) { // @codeCoverageIgnore
            return $e->getMessage(); // @codeCoverageIgnore
        }

        $this->data = array_merge($this->data, $data);

        if (!array_key_exists('page', $this->data)) {
            $this->data['page'] = $_SERVER['REQUEST_URI'];
        }

        $dir = Tag::getConfig()['cache_dir'];

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $fname = getcwd() . '/' . $dir . '/' . md5($view) . '.phtml';

        $file = new File($fname);

        if (Tag::getConfig()['dev'] == 'production') {
            $file->open(); // @codeCoverageIgnore
        } elseif (Tag::getConfig()['dev'] == 'development') {
            $this->setCache($file, $content);
        }

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
            'Func',
            'Loop',
            'Condition',
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
