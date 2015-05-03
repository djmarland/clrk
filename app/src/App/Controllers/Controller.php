<?php
namespace App\Controllers;

use App\Presenter\MasterPresenter;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Main Controller Class, others to inherit from
 */
class Controller
{
    public $masterViewPresenter;

    /**
     * Initial setup of all Controller files
     */
    public function __construct()
    {
        $this->masterViewPresenter = new MasterPresenter();
    }

    /**
     * Set values that make it to the view
     * @param $key
     * @param $value
     * @param bool $inFeed
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
     * Once complete, render the view
     * @param $request Request
     * @param $app Application
     * @param $viewPath string optional
     * @return string
     */
    public function render(Request $request, Application $app, $viewPath)
    {
        $format = $request->get('format', null);
        if ($format == 'json') {
            return $app->json($this->masterViewPresenter->getFeedData());
        }
        $viewPath .= '.html.twig';
        return $app['twig']->render($viewPath, $this->masterViewPresenter->getData());
    }

    /**
     * Get the ServiceFactory
     * with the required config
     */
    protected function getServiceFactory()
    {

    }
}
