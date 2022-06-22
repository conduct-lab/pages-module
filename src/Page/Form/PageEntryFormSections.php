<?php namespace Anomaly\PagesModule\Page\Form;

use Anomaly\PagesModule\Page\PageModel;
use Anomaly\Streams\Platform\Addon\FieldType\FieldType;

/**
 * Class PageEntryFormSections
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageEntryFormSections
{

    /**
     * Handle the form sections.
     *
     * @param PageEntryFormBuilder $builder
     */
    public function handle(PageEntryFormBuilder $builder)
    {
        $builder->setSections(
            [
                'page' => [
                    'tabs' => [
                        'content' => [
                            'title' => 'anomaly.module.pages::tab.content',
                            'fields' => function (PageEntryFormBuilder $builder) {
                                return array_map(
                                    function (FieldType $field) {
                                        return 'entry_' . $field->getField();
                                    },
                                    array_filter(
                                        $builder->getFormFields()->base()->all(),
                                        function (FieldType $field) {
                                            return (!$field->getEntry() instanceof PageModel);
                                        }
                                    )
                                );
                            },
                        ],
                        'general' => [
                            'title' => 'anomaly.module.pages::tab.general',
                            'fields' => [
                                'page_title',
                                'page_slug',
                                'page_parent',
                                'page_enabled',
                                'page_publish_at',
                                'page_auto_update_modified_at',
                                'page_modified_at',
                                'page_display_modified_at',
                                'resource_hidden',
                                'resource_protected',
                            ],
                        ],
                        'seo' => [
                            'title' => 'anomaly.module.pages::tab.seo',
                            'fields' => [
                                'page_meta_title',
                                'page_meta_description',
                                'page_structured_data',
                            ],
                        ],
                        'share' => [
                            'title' => 'anomaly.module.pages::tab.share',
                            'fields' => [
                                'share',
                                'page_open_graph_type',
                                'page_open_graph_title',
                                'page_open_graph_description',
                                'page_open_graph_image',
                                'page_open_graph_card_type_twitter',
                                'page_open_graph_image_twitter',
                                'page_open_graph_raw',
                            ],
                        ],
                        'options' => [
                            'title' => 'anomaly.module.pages::tab.options',
                            'fields' => [
                                'page_home',
                                'page_visible',
                                'page_exact',
                                'page_allowed_roles',
                                'page_theme_layout',
                                'page_route_name',
                            ],
                        ],
//                        'redirects' => [
//                            'title'  => 'anomaly.module.pages::tab.redirects',
//                            'fields' => [
//                                'page_enabled',
//                                'page_publish_at',
//                                'page_home',
//                                'page_visible',
//                                'page_exact',
//                                'page_allowed_roles',
//                                'page_theme_layout',
//                                'page_parent',
//                                'page_route_name',
//                            ],
//                        ],
                    ],
                ],
            ]
        );
//        $builder->setSections(
//            [
//                'page'   => [
//                    'tabs' => [
//                        'general' => [
//                            'title'  => 'anomaly.module.pages::tab.general',
//                            'fields' => [
//                                'page_title',
//                                'page_slug',
//                            ],
//                        ],
//                        'seo'     => [
//                            'title'  => 'anomaly.module.pages::tab.seo',
//                            'fields' => [
//                                'page_meta_title',
//                                'page_meta_description',
//                            ],
//                        ],
//                        'options' => [
//                            'title'  => 'anomaly.module.pages::tab.options',
//                            'fields' => [
//                                'page_enabled',
//                                'page_publish_at',
//                                'page_home',
//                                'page_visible',
//                                'page_exact',
//                                'page_allowed_roles',
//                                'page_theme_layout',
//                                'page_parent',
//                                'page_route_name',
//                            ],
//                        ],
//                    ],
//                ],
//                'fields' => [
//                    'fields' => function (PageEntryFormBuilder $builder) {
//                        return array_map(
//                            function (FieldType $field) {
//                                return 'entry_' . $field->getField();
//                            },
//                            array_filter(
//                                $builder->getFormFields()->base()->all(),
//                                function (FieldType $field) {
//                                    return (!$field->getEntry() instanceof PageModel);
//                                }
//                            )
//                        );
//                    },
//                ],
//            ]
//        );
    }
}
