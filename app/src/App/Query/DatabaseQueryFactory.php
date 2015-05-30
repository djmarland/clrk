<?php

namespace App\Query;

use App\Mapper\Database\MapperFactory;
use App\Query\Database\DatabaseQuery;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Persistence\Mapping\Driver\StaticPHPDriver;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;

/**
 * Default factory setup
 * Class DatabaseQueryFactory
 * @package App\Infrastructure
 */
class DatabaseQueryFactory
{

    private $entityManager;

    /**
     * @param $host
     * @param $database
     * @param $username
     * @param $password
     * @param $driver
     */
    public function __construct(
        $host,
        $database,
        $username,
        $password,
        $driver
    ) {
      //  $config = Setup::createConfiguration();
        $connectionParams = array(
            'dbname'    => $database,
            'user'      => $username,
            'password'  => $password,
            'host'      => $host,
            'driver'    => $driver
        );



        $config = new Configuration();
        $driverImpl = $config->newDefaultAnnotationDriver(__DIR__ . '/../Client/Database/Entity');

        //       $config->setMetadataDriverImpl(new StaticPHPDriver([]));
        $config->setMetadataDriverImpl($driverImpl);
        $config->setMetadataCacheImpl(new ArrayCache()); // @todo - allow this to use APC
        $config->setProxyDir(__DIR__ . '/Proxies');
        $config->setProxyNamespace('Proxies');
        $this->entityManager = EntityManager::create($connectionParams, $config);
    }

    /**
     * @param $queryName
     * @return DatabaseQuery
     */
    public function createQuery($queryName)
    {
        $mapperFactory = new MapperFactory();

        $className = '\App\Query\Database\\' . $queryName . 'Query';
        return new $className($this->entityManager, $mapperFactory);
    }
}
