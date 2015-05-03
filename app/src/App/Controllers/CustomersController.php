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
class CustomersController extends Controller
{
    /**
     * Home (/)
     * @param Request $request
     * @param Application $app
     * @return Twig
     */
    public function listAction(Request $request, Application $app)
    {
        $customer1 = new \App\Domain\Entity\Customer(
            new \App\Domain\ValueObject\ID(123),
            'John Doe'
        );


        $customer2 = new \App\Domain\Entity\Customer(
            new \App\Domain\ValueObject\ID(124),
            'Susan Doyle'
        );


        $this->set('customers', array(
            new \App\Presenter\Organism\Customer\CustomerPresenter($customer1),
            new \App\Presenter\Organism\Customer\CustomerPresenter($customer2)
        ))
             ->set('name', 'Bob');
        return $this->render($request, $app, 'customers/list');
    }
}
