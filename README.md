Custom HTMLPurifier Filter
=========================

If you are using Vue with back-end rendering you may be exposed to xss issues. If a user submits properly formatted code with {{ }}'s Vue will try to execute it (see https://github.com/dotboris/vuejs-serverside-template-xss)

Features
--------

* This package will replace or remove {{ }} using HTMLPurifier Custom Filter

Usage:

composer require rettigd/custom-filter

update the purifier config...

```<?php

return [
    "settings" => [
        "default" => [
            "HTML.SafeIframe"      => 'true',
            "URI.SafeIframeRegexp" => "%^(http://|https://|//)(www.youtube.com/embed/|player.vimeo.com/video/)%",
            "Filter.Custom"        => [ new rettigd\CustomHTMLPurifierFilter\CurlyBraceFilter($option = null, $callback = null) ]
        ],
        "titles"  => [
            'AutoFormat.AutoParagraph' => false,
            'AutoFormat.Linkify'       => false,
        ]
    ],
];
```

Option
------
```$option = null; // converts {{ code }} to '&#123;&#xfeff;&#123;&#xfeff; code &#125;&#xfeff;&#125;&#xfeff;'```

```$option = 'replace'; // converts {{ code }} to ' code '```

```$option = 'delete'; // converts {{ code }} to ''```

```$option = ['[',']'];  // converts {{ code }} to '[[ code ]]' //replace with any string or array```

Also, add an optional callback if you want to throw an error or change the html yourself;