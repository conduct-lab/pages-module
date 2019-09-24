<?php namespace Anomaly\PagesModule\Http\Controller;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\PagesModule\Page\PageResolver;
use Anomaly\Streams\Platform\Http\Controller\PublicController;
use Anomaly\Streams\Platform\View\ViewTemplate;
use Illuminate\Routing\Route;

/**
 * Class PagesController
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PagesController extends PublicController
{

    /**
     * Return a rendered page.
     *
     * @param  PageResolver $resolver
     * @param  ViewTemplate $template
     * @return null|\Symfony\Component\HttpFoundation\Response
     */
    public function view(PageResolver $resolver, ViewTemplate $template)
    {
        if (!$page = $resolver->resolve()) {
            abort(404);
        }

        $page->setCurrent(true);
        $page->setActive(true);

        $type    = $page->getType();
        $handler = $type->getHandler();

        $template->set('page', $page);

        $handler->make($page);

        return $page->getResponse();
    }

    /**
     * Preview a page.
     *
     * @param  ViewTemplate $template
     * @param  PageRepositoryInterface $pages
     * @param                                                  $id
     * @return null|\Symfony\Component\HttpFoundation\Response
     */
    public function preview(ViewTemplate $template, PageRepositoryInterface $pages, $id)
    {
        if (!$page = $pages->findByStrId($id)) {
            abort(404);
        }

        $type    = $page->getType();
        $handler = $type->getHandler();

        $template->set('page', $page);

        $handler->make($page);

        return $page->getResponse();
    }

    /**
     * Redirect elsewhere.
     *
     * @param PageRepositoryInterface $pages
     * @param Route $route
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect(PageRepositoryInterface $pages, Route $route)
    {
        if ($to = array_get($route->getAction(), 'anomaly.module.pages::redirect')) {
            return redirect($to, array_get($route->getAction(), 'status', 302));
        }

        /* @var PageInterface $page */
        if ($page = $pages->find(array_get($route->getAction(), 'anomaly.module.pages::page', 0))) {
            return redirect($page->getPath(), array_get($route->getAction(), 'status', 302));
        }

        return abort(404);
    }
}
