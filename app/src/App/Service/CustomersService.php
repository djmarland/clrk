<?php

namespace App\Service;

/**
 * Default factory setup
 * Class ServiceFactory
 * @package App\Infrastructure
 */
class CustomersService extends Service
{


    public function getAlphabetical(
        $perPage = null,
        $page = null
    ) {

        $query = $this->getMySQLQueryFactory()->createQuery('Customers');
        $query->sortAlphabetically();
        $query->setPagination(
            $perPage,
            $page
        );

        return $query->getResult();
    }
}
