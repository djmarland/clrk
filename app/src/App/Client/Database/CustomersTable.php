<?php

namespace App\Client\Database;

use App\Query\Database\Result;

/**
 * Class SQLClient
 */
class CustomersTable extends DatabaseClient
{

    /**
     * @param $dbSettings
     */
    public function __construct(
        $dbSettings
    ) {

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
