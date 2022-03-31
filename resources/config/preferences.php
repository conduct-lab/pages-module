<?php

return [
    'page_view' => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'options' => [
                'tree'  => 'anomaly.module.pages::preferences.page_view.option.tree',
                'table' => 'anomaly.module.pages::preferences.page_view.option.table',
            ],
        ],
    ],
    'page_entries_in_menu' => [
        'type'   => 'anomaly.field_type.select',
        'config' => [
            'options' => [
                'N'  => 'anomaly.module.pages::preferences.page_entries_in_menu.option.no',
                'Y' => 'anomaly.module.pages::preferences.page_entries_in_menu.option.yes',
            ],
        ],
    ],
];
