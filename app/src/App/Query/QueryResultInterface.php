<?php

namespace App\Query;

/**
 * QueryInterface Interface
 */
interface QueryResultInterface
{
    public function getItems();
    public function getTotal();
    public function getDomainModels();
}
