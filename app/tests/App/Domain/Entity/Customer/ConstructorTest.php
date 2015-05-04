<?php

namespace UnitTest\App\Domain\Entity\Customer;

use App\Domain\Entity\Customer;
use App\Domain\ValueObject\ID;
use App\Domain\ValueObject\Address;
use App\Domain\ValueObject\PostCode;

class ConstructorTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructorDefaults()
    {
        $id = new ID(123);
        $name = 'Lucy Luck';
        $customer = new Customer(
            $id,
            $name
        );

        $this->assertSame($id, $customer->getId());
        $this->assertSame($name, $customer->getName());
        $this->assertNull($customer->getAddress());
    }

    public function testConstructorFull()
    {
        $street = '95 Second Avenue';
        $postcode = new PostCode('EX2 7BH');
        $address = new Address(
            $street,
            $postcode
        );

        $id = new ID(123);
        $name = 'Lucy Luck';
        $customer = new Customer(
            $id,
            $name,
            $address
        );

        $this->assertSame($id, $customer->getId());
        $this->assertSame($name, $customer->getName());
        $this->assertSame($address, $customer->getAddress());
    }
}
