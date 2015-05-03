<?php

namespace App\Query\MySQL;

/**
 * Customers table
 * Class CustomersQuery
 * @package App\Query\MySQL
 */
class CustomersQuery extends MySQLQuery
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
