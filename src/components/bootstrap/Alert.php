<?php

namespace app\bootstrap;

use app\HtmlTag;

class Alert extends HtmlTag
{
    public function __construct(
        string $id,
        string $className,
        array $styles,
        string $innerHtml,
        array $customAtributes = []
    ) 
    {
        parent::__construct(
            'div',
            $id,
            'alert alert-' . $className,
            $styles,
            $innerHtml,
            $customAtributes
        );
    }
}