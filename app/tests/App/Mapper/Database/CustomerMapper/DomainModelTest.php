<?php

namespace UnitTest\App\Mapper\Database\CustomerMapper;

use App\Domain\Entity\Customer;
use App\Domain\ValueObject\ID;
use App\Mapper\Database\CustomerMapper;
use App\Mapper\Database\MapperFactory;

class DomainModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var CustomerMapper
     */
    private $mapper;

    public function setUp()
    {
        $factory = new MapperFactory();
        $this->mapper = new CustomerMapper($factory);
    }

    public function testCreateStandardDomainModel()
    {
        $name = 'Jeff Jeffries';
        $date = new \DateTime();

        $input = (object) [
            'id'    => 1,
            'name'  => $name,
            'createdAt' => $date,
            'updatedAt' => $date
        ];

        $customer = $this->mapper->getDomainModel($input);
        $id = $customer->getId();

        $this->assertTrue($customer instanceof Customer);
        $this->assertTrue($id instanceof ID);
        $this->assertSame(1, $id->getId());
        $this->assertSame($name, $customer->getName());
    }
}
