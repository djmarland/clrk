<?php

namespace App\Client\MySQL;

use App\Query\MySQL\Result;

/**
 * Class SQLClient
 */
class SQLClient
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

    public function getResult()
    {
        // @todo this is where a SQL query is constructed
        // based on what we've set so far

        // for now, you get a mock
        return new Result([
            [
                'id' => 1,
                'name' => 'Will Sasso'
            ],
            [
                'id' => 2,
                'name' => 'Bryan Callen'
            ]
        ]);
    }
}
