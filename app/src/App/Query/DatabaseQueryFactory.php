<?php

namespace App\Query;

use App\Mapper\Database\MapperFactory;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\Common\Persistence\Mapping\Driver\StaticPHPDriver;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;

/**
 * Default factory setup
 * Class DatabaseQueryFactory
 * @package App\Infrastructure
 * @internal
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
        $config->setMetadataDriverImpl(new StaticPHPDriver([]));
        $config->setMetadataCacheImpl(new ArrayCache()); // @todo - allow this to use APC
        $config->setProxyDir(__DIR__ . '/Proxies');
        $config->setProxyNamespace('Proxies');
        //$this->connection = DriverManager::getConnection($connectionParams, $config);
        $this->entityManager = EntityManager::create($connectionParams, $config);
        //$this->entityManager->getConfiguration()($driver);
    }

    /**
     * @param $queryName
     * @return QueryInterface
     */
    public function createQuery($queryName)
    {
        // @todo - database info should have been passed through

      //  $table = '\App\Client\Database\\' . $queryName . 'Table';
       // $dbClient = new $table($this->connection);

        $mapperFactory = new MapperFactory();

        $className = '\App\Query\Database\\' . $queryName . 'Query';
        return new $className($this->entityManager, $mapperFactory);
    }
}
