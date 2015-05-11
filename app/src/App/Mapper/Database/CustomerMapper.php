<?php

namespace App\Mapper\Database;

use App\Domain\Entity\Customer;
use App\Domain\ValueObject\ID;

class CustomerMapper extends Mapper
{
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
