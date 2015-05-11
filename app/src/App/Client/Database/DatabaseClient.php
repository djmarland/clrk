<?php

namespace App\Client\Database;

use Doctrine\DBAL\Driver\Connection;

/**
 * Class DatabaseClient
 */
abstract class DatabaseClient implements DatabaseClientInterface
{
    /**
     * @var
     */
    protected $connection;

    /**
     * @param Connection $connection
     */
    public function __construct(
        Connection $connection
    ) {
        $this->connection = $connection;
    }

    /**
     * @var int
     */
    private $limit;

    /**
     * @param $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @var int
     */
    private $offset;

    /**
     * @param $offset
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
    }

    /**
     * @var string
     */
    private $sort;

    /**
     * @param $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }
}
