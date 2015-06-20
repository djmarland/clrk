<?php
/**
 * Home Controller
 *
 * @category Class
 * @package  App
 */
namespace App\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * For the standard 'Home' paths
 */
class HomeController extends Controller
{
    /**
     * Home (/)
     * @param Request $request
     * @return mixed
     */
    public function indexAction(Request $request)
    {
        $this->set('name', 'John');

        if ($request->getMethod() == 'POST') {
            $applicationName = $request->request->get('application-name');
            $settings = $this->get('settings');
            $settings->setApplicationName($applicationName);

            $this->getServiceFactory()
                ->createService('Settings')
                ->save($settings);

            $this->set('settings', $settings);
        }

        return $this->render($request, 'home/index');
    }

    public function loginAction(Request $request)
    {
        $this->set('loginError', $this->app['security.last_error']($request));
        $this->set('lastUsername', $this->app['session']->get('_security.last_username'));

        return $this->render($request, 'home/login');
    }

    /**
     * Style guide (/styleguide)
     * @param Request $request
     * @return mixed
     */
    public function styleguideAction(Request $request)
    {
        return $this->render($request, 'home/styleguide');
    }
}
