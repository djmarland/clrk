<?php
namespace UnitTest\App\Presenter\CustomerPresenter;

use App\Domain\Entity\Customer;
use App\Domain\ValueObject\ID;
use App\Presenter\Organism\Customer\CustomerPresenter;

class ConstructorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetValuesFromDomain()
    {
        $name = 'Wendy Strong';

        $customer = new Customer(
            new ID(0),
            $name
        );

        $presenter = new CustomerPresenter(
            $customer
        );

        $this->assertEquals($name, $presenter->getName());
    }
}
