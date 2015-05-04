<?php

namespace App\Infrastructure\Silex;

use App\Infrastructure\ServiceFactory;
use App\Query\DatabaseQueryFactory;
use App\Service\Service;

/**
 * Default factory setup
 * Class ServiceFactory
 * @package App\Infrastructure
 */
class SilexServiceFactory extends ServiceFactory
{

    public function __construct($app)
    {

        $databaseQueryFactory = $this->getDatabaseQueryFactoryBuilder($app);

        parent::__construct(
            [
                Service::FACTORY_DATABASE => $databaseQueryFactory
            ]
        );
    }

    private function getDatabaseQueryFactoryBuilder($app)
    {
        // @todo - get the real silex info
        $host = 'bob';
        $database = 'bob';
        $username = 'bob';
        $password = 'bob';

        return new DatabaseQueryFactory(
            $host,
            $database,
            $username,
            $password
        );
    }
}
