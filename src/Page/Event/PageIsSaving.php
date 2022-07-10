<?php

namespace Anomaly\PagesModule\Page\Event;

use Anomaly\PagesModule\Page\Contract\PageInterface;

class PageIsSaving
{
    /**
     * The page object.
     *
     * @var PageInterface
     */
    protected $page;

    /**
     * Create a new PageWasCreated instance.
     *
     * @param PageInterface $user
     */
    public function __construct(PageInterface $page)
    {
        $this->page = $page;
    }

    /**
     * Get the page.
     *
     * @return PageInterface
     */
    public function getPage()
    {
        return $this->page;
    }
}
