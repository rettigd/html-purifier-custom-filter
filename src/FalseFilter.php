<?php namespace rettigd\CustomHTMLPurifierFilter;

use rettigd\CustomHTMLPurifierFilter;

/*
/* Converts false to "0" since default behaviour is to convert to empty string ("")
*/

class FalseFilter implements CustomFilterInterface
{
    protected $option;
    protected $callback;

    public function __construct($option = 'convert', callable $callback = null)
    {
        $this->option = $option;
        $this->callback = $callback;
    }
    public function preFilter($html, $config, $context)
    {
        return $html === false ? "0" : $html;
    }

    public function postFilter($html, $config, $context)
    {
        return $html;
    }
}