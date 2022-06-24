<?php

return [
    'page_speed_enable' => [
        'type'   => 'anomaly.field_type.boolean',
        'config' => [
            'default_value' => env('LARAVEL_PAGE_SPEED_ENABLE', true),
        ],
    ],
    'page_speed_skip_paths' => [
        'type'   => 'anomaly.field_type.textarea',
        'config' => [
            'default_value' => 'admin/*; *.xml; *.less; *.pdf; *.doc; *.txt; *.ico; *.rss; *.zip; *.mp3; *.rar; *.exe; *.wmv; *.doc; *.avi; *.ppt; *.mpg; *.mpeg; *.tif; *.wav; *.mov; *.psd; *.ai; *.xls; *.mp4; *.m4a; *.swf; *.dat; *.dmg; *.iso; *.flv; *.m4v; *.torrent',
        ],
    ],
];
