<?php
namespace App\Controllers;

use App\Infrastructure\Silex\SilexServiceFactory;
use App\Presenter\MasterPresenter;
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
        $this->setPage();
        $this->pre();
    }

    /**
     * Setup common tasks for a controller
     */
    protected function pre()
    {
        // nothing in the mail controller
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

    private function setPage()
    {

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
     * @param $app Application
     * @param $viewPath string optional
     * @return string
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
