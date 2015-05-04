<?php

namespace App\Query\Database;

/**
 * Customers table
 * Class CustomersQuery
 * @package App\Query\MySQL
 */
class CustomersQuery extends DatabaseQuery
{

    /**
     * @return $this
     */
    public function sortAlphabetically()
    {
        $this->setSort('name ASC');
        return $this;
    }
}
