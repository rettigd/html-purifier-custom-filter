<?php
namespace rettigd\CustomHTMLPurifierFilter;

interface CustomFilterInterface
{
    function preFilter($html, $config, $context);
    function postFilter($html, $config, $context);
}