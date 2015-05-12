<?php

namespace App\Query\Database;

/**
 * Customers table
 * Class CustomersQuery
 * @package App\Query\Database
 */
class CustomersQuery extends DatabaseQuery
{

    /**
     * @return $this
     */
    public function order()
    {
        $this->sortBy('name');
        return $this;
    }

    public function getResult($data)
    {
        return null;
    }
}
