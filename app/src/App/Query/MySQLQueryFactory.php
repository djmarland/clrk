<?php

namespace App\Query;

use App\Client\MySQL\SQLClient;
use App\Mapper\MySQL\MapperFactory;

/**
 * Default factory setup
 * Class ServiceFactory
 * @package App\Infrastructure
 */
class MySQLQueryFactory
{

    /**
     * @var
     */
    private $host;

    /**
     * @var
     */
    private $database;

    /**
     * @var
     */
    private $username;

    /**
     * @var
     */
    private $password;

    public function __construct(
        $host,
        $database,
        $username,
        $password
    ) {
        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }

    public function createQuery($queryName)
    {
        // @todo - database info should have been passed through
        $dbClient = new SQLClient(array());
        $mapperFactory = new MapperFactory();

        $className = '\App\Query\MySQL\\' . $queryName . 'Query';
        return new $className($dbClient, $mapperFactory);
    }
}
