<?php

namespace App\Service;

use App\Query\Database\DatabaseQuery;

/**
 * Default factory setup
 * Class ServiceFactory
 * @package App\Infrastructure
 */
class CustomersService extends Service
{


    public function getAlphabetical(
        $perPage = DatabaseQuery::DEFAULT_PAGESIZE,
        $page = DatabaseQuery::DEFAULT_PAGE
    ) {

        $query = $this->getDatabaseQueryFactory()->createQuery('Customers');
        $query->order();
        $query->setPagination(
            $perPage,
            $page
        );

        return $query->getResult();
    }
}
