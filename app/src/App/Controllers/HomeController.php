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
     * @param Request     $request
     * @param Application $app
     * @return mixed
     */
    public function indexAction(Request $request)
    {
        $this->set('name', 'John');
        return $this->render($request, 'home/index');
    }

    /**
     * Styleguide (/styleguide)
     * @param Request     $request
     * @param Application $app
     * @return mixed
     */
    public function styleguideAction(Request $request)
    {
        return $this->render($request, 'home/styleguide');
    }
}
