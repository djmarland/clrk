<?php

namespace App\Infrastructure\Silex;

use App\Infrastructure\ServiceFactory;
use App\Query\MySQLQueryFactory;

/**
 * Default factory setup
 * Class ServiceFactory
 * @package App\Infrastructure
 */
class SilexServiceFactory extends ServiceFactory
{

    public function __construct($app)
    {

        $mySQLQueryFactory = $this->getMySQLQueryFactoryBuilder($app);

        parent::__construct(
            [
            'MySQL' => $mySQLQueryFactory
            ]
        );
    }

    private function getMySQLQueryFactoryBuilder($app)
    {
        // @todo - get the real silex info
        $host = 'bob';
        $database = 'bob';
        $username = 'bob';
        $password = 'bob';

        return new MySQLQueryFactory(
            $host,
            $database,
            $username,
            $password
        );
    }
}
