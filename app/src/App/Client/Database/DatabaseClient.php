<?php

namespace App\Client\Database;

/**
 * Class DatabaseClient
 */
abstract class DatabaseClient implements DatabaseClientInterface
{

    /**
     * @param $dbSettings
     */
    public function __construct(
        $dbSettings
    ) {

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
