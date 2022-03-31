<?php namespace Anomaly\PagesModule;

use Anomaly\PagesModule\Page\PageModel;
use Anomaly\PagesModule\Page\Tree\PageTreeBuilder;
use Anomaly\PreferencesModule\Preference\Contract\PreferenceRepositoryInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Anomaly\Streams\Platform\Ui\Tree\Command\BuildTree;
use Anomaly\Streams\Platform\Ui\Tree\TreeBuilder;

/**
 * Class PagesModuleSections
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PagesModuleSections
{

    /**
     * Handle the sections.
     *
     * @param ControlPanelBuilder $builder
     * @param PreferenceRepositoryInterface $preferences
     */
    public function handle(ControlPanelBuilder $builder, PreferenceRepositoryInterface $preferences, PageTreeBuilder $treeBuilder)
    {
        $view = $preferences->value('anomaly.module.pages::page_view', 'tree');
        $entriesInMenu = $preferences->value('anomaly.module.pages::page_entries_in_menu', 'N');

        $treeBuilder->dispatchSync(new BuildTree($treeBuilder));

        $builder->addSection('pages', [
            'buttons' => [
                'new_page' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href' => 'admin/pages/types/choose',
                ],
                'change_view' => [
                    'type' => 'info',
                    'enabled' => 'admin/pages',
                    'icon' => ($view == 'tree' ? 'fa fa-table' : 'list-ul'),
                    'href' => 'admin/pages/change/' . ($view == 'tree' ? 'table' : 'tree'),
                    'text' => 'anomaly.module.pages::button.' . ($view == 'tree' ? 'table_view' : 'tree_view'),
                ],
            ],
        ]);

        if ($entriesInMenu == 'Y') {
            $treeEntries = $treeBuilder->getTreeEntries()->sort(function ($entryA, $entryB) {
                return $entryA->sort_order <=> $entryB->sort_order;
            });

            $this->buildPagesTree($builder, $treeEntries);
        }

        $builder->addSection('types', [
            'buttons' => [
                'new_type',
            ],
            'sections' => [
                'assignments' => [
                    'hidden' => true,
                    'href' => 'admin/pages/types/assignments/{request.route.parameters.stream}',
                    'buttons' => [
                        'assign_fields' => [
                            'data-toggle' => 'modal',
                            'data-target' => '#modal',
                            'href' => 'admin/pages/types/assignments/{request.route.parameters.stream}/choose',
                        ],
                    ],
                ],
            ],
        ]);
        $builder->addSection('fields', [
            'buttons' => [
                'new_field' => [
                    'data-toggle' => 'modal',
                    'data-target' => '#modal',
                    'href' => 'admin/pages/fields/choose',
                ],
            ],
        ]);
    }

    private function buildPagesTree($builder, $entries, $parentId = null, int $level = 0)
    {
        foreach ($entries as $entry) {
            if ($entry->parent_id === $parentId) {
                $icon = 'fas fa-file-alt';
                if ($entry->home) {
                    $icon = 'fas fa-home';
                }
                if ($entry->visible == 0) {
                    $icon = 'fas fa-eye-slash';
                }
                if ($entry->enabled == 0) {
                    $icon = 'fas fa-minus-square';
                }
                $builder->addSection($entry->str_id, [
                    'title' => '' . $entry->title,
                    'href' => 'admin/pages/edit/' . $entry->id,
                    'icon' => 'icon ' . $icon,
                    'class' => 'level-' . $level,
                ]);

                $this->buildPagesTree($builder, $entries, $entry->id, $level + 1);
            }
        }
    }
}
