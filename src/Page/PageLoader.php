<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Contract\PageInterface;

/**
 * Class PageLoader
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageLoader
{

    /**
     * Load page data to the template.
     *
     * @param PageInterface $page
     */
    public function load(PageInterface $page)
    {
        share('title', $page->getTitle());
        share('meta_title', $page->getMetaTitle());
        share('meta_description', $page->getMetaDescription());
    }
}
