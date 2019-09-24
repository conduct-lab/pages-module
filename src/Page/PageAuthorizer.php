<?php namespace Anomaly\PagesModule\Page;

use Anomaly\PagesModule\Page\Contract\PageInterface;
use Anomaly\Streams\Platform\Support\Authorizer;
use Anomaly\UsersModule\Role\RoleCollection;
use Anomaly\UsersModule\User\Contract\UserInterface;
use Illuminate\Routing\ResponseFactory;

/**
 * Class PageAuthorizer
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class PageAuthorizer
{

    /**
     * The response factory.
     *
     * @var ResponseFactory
     */
    protected $response;

    /**
     * The authorizer utility.
     *
     * @var Authorizer
     */
    protected $authorizer;

    /**
     * Create a new PageAuthorizer instance.
     *
     * @param Authorizer $authorizer
     * @param ResponseFactory $response
     */
    public function __construct(Authorizer $authorizer, ResponseFactory $response)
    {
        $this->response   = $response;
        $this->authorizer = $authorizer;
    }

    /**
     * Authorize the page.
     *
     * @param PageInterface $page
     */
    public function authorize(PageInterface $page)
    {
        /* @var UserInterface $user */
        $user = auth()->user();

        /* @var RoleCollection $allowed */
        $allowed = $page->getAllowedRoles();

        /*
         * If the page is not enabled yet check and make
         * sure that we are allowed to preview it first.
         */
        if (!$page->isLive() && !$this->authorizer->authorize('anomaly.module.pages::pages.preview')) {
            abort(403);
        }

        /*
         * Check the roles against the
         * user if there are any.
         */
        if (
            $page->isLive()
            && !$allowed->isEmpty()
            && (!$user || (!$user->hasAnyRole($allowed) && !$user->isAdmin()))
        ) {
            $page->setResponse($this->response->redirectGuest('login'));
        }
    }
}
