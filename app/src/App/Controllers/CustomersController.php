<?php
/**
 * Home Controller
 *
 * @category Class
 * @package  App
 */
namespace App\Controllers;

use App\Presenter\Organism\Customer\CustomerPresenter;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * For the standard 'Home' paths
 */
class CustomersController extends Controller
{
    /**
     * Home (/)
     * @param Request     $request
     * @param Application $app
     * @return Twig
     */
    public function listAction(Request $request, Application $app)
    {
        $customersService = $this->getServiceFactory($app)
            ->createService('Customers');

        $customers = $customersService->getAlphabetical();

        $presenters = array();
        foreach($customers->getDomainModels() as $customer) {
            $presenters[] = new CustomerPresenter($customer);
        }
        /*
        $customer1 = new \App\Domain\Entity\Customer(
            new \App\Domain\ValueObject\ID(123),
            'John Doe'
        );


        $customer2 = new \App\Domain\Entity\Customer(
            new \App\Domain\ValueObject\ID(124),
            'Susan Doyle'
        );
        */

        $this->set('customers', $presenters)
            ->set('name', 'Bob');
        return $this->render($request, $app, 'customers/list');
    }
}
