<?php namespace Anomaly\PagesModule\Page;

use Anomaly\EditorFieldType\EditorFieldType;
use Anomaly\EditorFieldType\EditorFieldTypePresenter;
use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Support\Template;

/**
 * Class PageContent
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageContent
{

    /**
     * The template engine.
     *
     * @var Template
     */
    protected $template;

    /**
     * Create a new PageContent instance.
     *
     * @param Template $template
     */
    public function __construct(Template $template)
    {
        $this->template = $template;
    }

    /**
     * Make the view content.
     *
     * @param PageInterface $page
     */
    public function make(PageInterface $page)
    {
        $type = $page->getType();

        /* @var EditorFieldType $layout */
        /* @var EditorFieldTypePresenter $presenter */
        $layout    = $type->getFieldType('layout');
        $presenter = $type->getFieldTypePresenter('layout');

        $view = $layout->getViewPath();

        if (
            strpos($presenter->content(), '{% block') !== false &&
            strpos($presenter->content(), '{% extends') === false
        ) {
            $view = $this->template->make(
                '{% extends page.theme_layout.key ?: page.type.theme_layout.key %}' . $presenter->content()
            );
        }

        $page->setContent(view($view, compact('page'))->render());

        /**
         * If the type layout is taking the
         * reigns then allow it to do so.
         *
         * This will let layouts natively
         * extend parent view blocks.
         */
        if (
            strpos($presenter->content(), '{% extends') !== false ||
            strpos($presenter->content(), '{% block') !== false
        ) {
            $page->setResponse(response($page->getContent()));

            return;
        }
    }
}
