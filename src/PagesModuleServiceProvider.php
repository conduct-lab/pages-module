<?php namespace Anomaly\PagesModule;

use Anomaly\PagesModule\Console\Dump;
use Anomaly\PagesModule\Http\Controller\Admin\AssignmentsController;
use Anomaly\PagesModule\Http\Controller\Admin\FieldsController;
use Anomaly\PagesModule\Http\Controller\Admin\VersionsController;
use Anomaly\PagesModule\Listener\RefreshPagesModule;
use Anomaly\PagesModule\Page\Command\DumpPages;
use Anomaly\PagesModule\Page\Contract\PageRepositoryInterface;
use Anomaly\PagesModule\Page\PageModel;
use Anomaly\PagesModule\Page\PageRepository;
use Anomaly\PagesModule\Page\PageTranslationsModel;
use Anomaly\PagesModule\Type\Contract\TypeRepositoryInterface;
use Anomaly\PagesModule\Type\TypeModel;
use Anomaly\PagesModule\Type\TypeRepository;
use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Application\Event\SystemIsRefreshing;
use Anomaly\Streams\Platform\Assignment\AssignmentRouter;
use Anomaly\Streams\Platform\Field\FieldRouter;
use Anomaly\Streams\Platform\Model\Pages\PagesPagesEntryModel;
use Anomaly\Streams\Platform\Model\Pages\PagesPagesEntryTranslationsModel;
use Anomaly\Streams\Platform\Model\Pages\PagesTypesEntryModel;
use Anomaly\Streams\Platform\Version\VersionRouter;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

/**
 * Class PagesModuleServiceProvider
 *
 * @link   http://pyrocms.com/
 * @author PyroCMS, Inc. <support@pyrocms.com>
 * @author Ryan Thompson <ryan@pyrocms.com>
 */
class PagesModuleServiceProvider extends AddonServiceProvider
{

    /**
     * The addon commands.
     *
     * @var array
     */
    protected $commands = [
        Dump::class,
    ];

    /**
     * The addon plugins.
     *
     * @var array
     */
    protected $plugins = [
        PagesModulePlugin::class,
    ];

    /**
     * The addon middleware.
     *
     * @type array|null
     */
    protected $middleware = [
        // https://8bityard.com/how-to-minify-html-in-laravel-8/
        // https://github.com/renatomarinho/laravel-page-speed
        \RenatoMarinho\LaravelPageSpeed\Middleware\ElideAttributes::class,
        \RenatoMarinho\LaravelPageSpeed\Middleware\InsertDNSPrefetch::class,
        \RenatoMarinho\LaravelPageSpeed\Middleware\RemoveComments::class,
        \RenatoMarinho\LaravelPageSpeed\Middleware\CollapseWhitespace::class, // Note: This middleware invokes "RemoveComments::class" before it runs.
    ];

    /**
     * The addon listeners.
     *
     * @var array
     */
    protected $listeners = [
        SystemIsRefreshing::class => [
            RefreshPagesModule::class,
        ],
    ];

    /**
     * The class bindings.
     *
     * @var array
     */
    protected $bindings = [
        PagesPagesEntryModel::class => PageModel::class,
        PagesTypesEntryModel::class => TypeModel::class,
        PagesPagesEntryTranslationsModel::class => PageTranslationsModel::class,
    ];

    /**
     * The singleton bindings.
     *
     * @var array
     */
    protected $singletons = [
        PageRepositoryInterface::class => PageRepository::class,
        TypeRepositoryInterface::class => TypeRepository::class,
    ];

    /**
     * The addon routes.
     *
     * @var array
     */
    protected $routes = [
        'pages/preview/{id}' => 'Anomaly\PagesModule\Http\Controller\PagesController@preview',
    ];

    /**
     * Register the addon.
     */
    public function boot()
    {
        // Run extra pre-boot registration logic here.
        // Use method injection or commands to bring in services.
//        Config::set('laravel-page-speed.enable', false);
        $settings = app(SettingRepositoryInterface::class);
        $enablePageSpeed = $settings->get('anomaly.module.pages::page_speed_enable');
        $pageSpeedSkipPathsString = $settings->get('anomaly.module.pages::page_speed_skip_paths');

        if ($enablePageSpeed) {
            Config::set('laravel-page-speed.enable', $enablePageSpeed->getValue());
        }

        if ($pageSpeedSkipPathsString) {
            $pageSpeedSkipPathsString = Str::replace("\n", '', $pageSpeedSkipPathsString->getValue());
            $pageSpeedSkipPaths = explode(';', $pageSpeedSkipPathsString);
            foreach ($pageSpeedSkipPaths as $key => $pageSpeedSkipPath) {
                $pageSpeedSkipPaths[$key] = trim($pageSpeedSkipPath);
            }
            if (!in_array('admin/*', $pageSpeedSkipPaths)) {
                $pageSpeedSkipPaths[] = 'admin/*';
            }
            Config::set('laravel-page-speed.skip', $pageSpeedSkipPaths);
        }
    }

    /**
     * Map additional routes.
     *
     * @param FieldRouter $fields
     * @param VersionRouter $versions
     * @param AssignmentRouter $assignments
     */
    public function map(
        FieldRouter      $fields,
        VersionRouter    $versions,
        AssignmentRouter $assignments
    )
    {
        $versions->route($this->addon, VersionsController::class);

        $fields->route($this->addon, FieldsController::class);
        $assignments->route($this->addon, AssignmentsController::class, 'admin/pages/types');

        if (!file_exists($routes = app_storage_path('pages/routes.php'))) {
            dispatch_now(new DumpPages());
        }

        require $routes;
    }
}
