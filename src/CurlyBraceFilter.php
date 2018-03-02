<?php namespace rettigd\CustomHTMLPurifierFilter;

use rettigd\CustomHTMLPurifierFilter;

class CurlyBraceFilter implements CustomFilterInterface
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
        return $html;
    }

    public function postFilter($html, $config, $context)
    {
        $originalHTML = $html;
        $callback = $this->callback;

        switch ($this->option) {
            case 'convert' :
                $html = str_replace(['{','}'],['&#123;&#xfeff;', '&#125;&#xfeff;'], $html);
            break;

            case 'remove' :
                $html = str_replace(['{','}'], '', $html);
            break;

            case 'delete' :
                if (strpos($html, '{') !== false || strpos($html, '}') !== false) {
                    $html = '';
                }
            break;

            default :
                $html = str_replace(['{','}'], $this->option, $html);
        }

        if ($this->callback !== null) {
            $html = $callback($originalHTML, $html, $config, $context);
        }
        
        return $html;
    }
}