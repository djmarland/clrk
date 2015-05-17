<?php

namespace App\Infrastructure\Silex;

use App\Infrastructure\ServiceFactory;
use App\Query\DatabaseQueryFactory;
use App\Service\Service;
use Silex\Application;

/**
 * Default factory setup
 * Class ServiceFactory
 * @package App\Infrastructure
 */
class SilexServiceFactory extends ServiceFactory
{

    public function __construct(Application $app)
    {

        $databaseQueryFactory = $this->getDatabaseQueryFactory($app);

        parent::__construct(
            [
                Service::FACTORY_DATABASE => $databaseQueryFactory
            ]
        );
    }

    private function getDatabaseQueryFactory($app)
    {
        $host       = $app['config']->get('database.hostname');
        $database   = $app['config']->get('database.db_prefix') . $app['clientName'];
        $username   = $app['config']->get('database.user');
        $password   = $app['config']->get('database.password');
        $driver     = $app['config']->get('database.driver');

        return new DatabaseQueryFactory(
            $host,
            $database,
            $username,
            $password,
            $driver
        );
    }
}
