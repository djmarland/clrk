<?php

namespace App\Infrastructure\Silex;

use App\Infrastructure\ServiceFactory;
use App\Query\DatabaseQueryFactory;
use App\Query\EmailQueryFactory;
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
        $emailQueryFactory = $this->getEmailQueryFactory($app);

        parent::__construct(
            [
                Service::FACTORY_DATABASE => $databaseQueryFactory,
                Service::FACTORY_EMAIL    => $emailQueryFactory
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

    private function getEmailQueryFactory($app)
    {
        $host       = $app['config']->get('email.host');
        $username   = $app['config']->get('email.username');
        $password   = $app['config']->get('email.password');
        $from       = $app['config']->get('email.from');

        return new EmailQueryFactory(
            $host,
            $username,
            $password,
            $from
        );
    }
}
