<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Command\DumpPages;
use Anomaly\PagesModule\Page\Command\UnsetHome;
use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Event\PageWasCreated;
use Anomaly\PagesModule\Page\Event\PageIsCreating;
use Anomaly\PagesModule\Page\Event\PageWasDeleted;
use Anomaly\PagesModule\Page\Event\PageWasSaved;
use Anomaly\PagesModule\Page\Event\PageIsSaving;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;
use Anomaly\Streams\Platform\Entry\EntryModel;
use Anomaly\Streams\Platform\Entry\EntryObserver;

/**
 * Class PageObserver
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PageObserver extends EntryObserver
{

    /**
     * Fired before creating the page.
     *
     * @param EntryInterface|PageInterface|EntryModel $entry
     */
    public function creating(EntryInterface $entry)
    {
        event(new PageIsCreating($entry));
        $entry->setAttribute('str_id', str_random(24));

        parent::creating($entry);
    }

    /**
     * Fired before creating the page.
     *
     * @param EntryInterface|PageInterface|EntryModel $entry
     */
    public function created(EntryInterface $entry)
    {
        event(new PageWasCreated($entry));

        parent::created($entry);
    }

    /**
     * Fired before saving the page.
     *
     * @param EntryInterface|PageInterface|EntryModel $entry
     */
    public function saving(EntryInterface $entry)
    {
        event(new PageIsSaving($entry));
        $this->dispatch(new UnsetHome($entry));

        parent::saving($entry);
    }

    /**
     * Fired after saving the page.
     *
     * @param EntryInterface|PageInterface|EntryModel $entry
     */
    public function saved(EntryInterface $entry)
    {
        event(new PageWasSaved($entry));
        parent::saved($entry);

        $this->dispatch(new DumpPages());
    }

    /**
     * Fired after saving the page.
     *
     * @param EntryInterface|PageInterface|EntryModel $entry
     */
    public function deleted(EntryInterface $entry)
    {
        event(new PageWasDeleted($entry));
        parent::deleted($entry);

        $this->dispatch(new DumpPages());
    }
}
