<?php

namespace App\Mapper\Database;

use App\Domain\Entity\Customer;
use App\Domain\ValueObject\ID;

class CustomerMapper extends Mapper
{
    public function getDomainModel($item)
    {
        $id = new ID($item->id);
        $name = $item->name;
        $createdAt = $item->createdAt;
        $updatedAt = $item->updatedAt;
        $customer = new Customer(
            $id,
            $createdAt,
            $updatedAt,
            $name
        );
        return $customer;
    }
}
