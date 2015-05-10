<?php

namespace UnitTest\App\Domain\Mapper\Database\CustomerMapper;

use App\Domain\Entity\Customer;
use App\Domain\ValueObject\ID;
use App\Mapper\Database\CustomerMapper;

class DomainModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CustomerMapper
     */
    private $mapper;

    public function setUp()
    {
        $this->mapper = new CustomerMapper();
    }

    public function testCreateStandardDomainModel()
    {
        $name = 'Jeff Jeffries';

        $input = [
            'id'    => 1,
            'name'  => $name
        ];

        $customer = $this->mapper->getDomainModel($input);
        $id = $customer->getId();

        $this->assertTrue($customer instanceof Customer);
        $this->assertTrue($id instanceof ID);
        $this->assertSame(1, $id->getId());
        $this->assertSame($name, $customer->getName());
    }
}
