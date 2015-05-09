<?php

namespace App\Client\Database;

/**
 * Class SQLClient
 */

interface DatabaseClientInterface
{
    public function getResult();

    // standard database options (covered by the base model)
    public function setLimit($limit);
    public function setOffset($offset);
    public function setSort($sort);
}
