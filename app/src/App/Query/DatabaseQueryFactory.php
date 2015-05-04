<?php

namespace App\Query;

use App\Mapper\Database\MapperFactory;

/**
 * Default factory setup
 * Class DatabaseQueryFactory
 * @package App\Infrastructure
 */
class DatabaseQueryFactory
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

    /**
     * @param $queryName
     * @return QueryInterface
     */
    public function createQuery($queryName)
    {
        // @todo - database info should have been passed through

        $table = '\App\Client\Database\\' . $queryName . 'Table';
        $dbClient = new $table(array());
        $mapperFactory = new MapperFactory();

        $className = '\App\Query\Database\\' . $queryName . 'Query';
        return new $className($dbClient, $mapperFactory);
    }
}
