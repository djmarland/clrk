<?php

namespace App\Mapper\Database;

use App\Domain\Entity\Customer;
use App\Domain\ValueObject\ID;

/**
 * Factory to create mappers as needed
 */
class CustomerMapper
{

    public function __construct($hydratorFactory = null)
    {
    }

    public function getDomainModel($item)
    {
        $id = new ID($item['id']);
        $name = $item['name'];
        $customer = new Customer(
            $id,
            $name
        );
        return $customer;
    }
}
