<?php
namespace App\Controllers;

use App\Infrastructure\Silex\SilexServiceFactory;
use App\Presenter\MasterPresenter;
use App\Presenter\Organism\Pagination\PaginationPresenter;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Main Controller Class, others to inherit from
 */
abstract class Controller
{
    /**
     * @var
     */
    protected $serviceFactory;

    /**
     * @var Application
     */
    protected $app;

    /**
     * @var int
     */
    protected $currentPage = 1;

    /**
     * @var MasterPresenter
     */
    public $masterViewPresenter;

    /**
     * Initial setup of all Controller files
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->masterViewPresenter = new MasterPresenter();

        $this->getSettings();
        $this->pre();
    }

    /**
     * Setup common tasks for a controller
     */
    protected function pre()
    {
        // nothing in the main controller
    }

    private function getSettings()
    {
        // get the initial app settings
        $settings = $this->getServiceFactory()
            ->createService('Settings')
            ->get();

        if ($settings === null) {
            // if settings failed due to missing database: 404
            $this->app->abort(404, "Client does not exist");
        }

        // if app is not active, throw to "not ready" page
        if (!$settings->isActive()) {
            $message = ($settings->isSuspended()) ?
                        'Account has been suspended' :
                        'Account has not yet been initialised';
            $this->app->abort(202, $message);
        }

        $this->set('settings', $settings);
    }

    protected function getCurrentPage($request)
    {
        $page = $request->get('page', 1);

        // must be an integer string
        if (
            strval(intval($page)) !== strval($page) ||
            $page < 1
        ) {
            $this->app->abort(404, 'No such page value');
        }
        return (int) $page;
    }

    /**
     * @param int $total Total Results
     * @param int $currentPage The current page value
     * @param int $perPage How many per page
     */
    protected function setPagination(
        $total,
        $currentPage,
        $perPage
    ) {

        $pagination = new PaginationPresenter(
            $total,
            $currentPage,
            $perPage
        );

        if (!$pagination->isValid()) {
            $this->app->abort(404, 'There are not this many pages');
        }

        $this->set('pagination', $pagination);
    }

    /**
     * Set values that make it to the view
     * @param $key
     * @param $value
     * @param bool  $inFeed
     * @return $this
     */
    public function set(
        $key,
        $value,
        $inFeed = true
    ) {
        $this->masterViewPresenter->set($key, $value, $inFeed);
        return $this;
    }

    /**
     * @param $key
     * @return mixed
     * @throws \App\Domain\Exception\DataNotSetException
     */
    public function get($key)
    {
         return $this->masterViewPresenter->get($key);
    }

    /**
     * Once complete, render the view
     * @param $request Request
     * @param $viewPath string optional
     * @return string
     * @internal param Application $app
     */
    public function render(Request $request, $viewPath)
    {
        $format = $request->get('format', null);
        if ($format == 'json') {
            return $this->app->json($this->masterViewPresenter->getFeedData());
        }
        $viewPath .= '.html.twig';
        return $this->app['twig']->render($viewPath, $this->masterViewPresenter->getData());
    }

    public function renderEmail($viewPath, $mailData)
    {
        $viewPath = 'emails/' . $viewPath . '.html.twig';
        $data = $this->masterViewPresenter->getData();
        $data['email'] = $mailData;
        return $this->app['twig']->render($viewPath, $data);
    }

    /**
     * Get the ServiceFactory
     * with the required config
     * @return SilexServiceFactory
     */
    public function getServiceFactory()
    {
        if (!$this->serviceFactory) {
            // I'm a silex app, so I'm going to call
            // the Silex Service Factory and pass in myself
            $this->serviceFactory = new SilexServiceFactory($this->app);
        }
        return $this->serviceFactory;
    }

    /**
     * @param $factory
     */
    public function setServiceFactory($factory)
    {
        $this->serviceFactory = $factory;
    }
}
