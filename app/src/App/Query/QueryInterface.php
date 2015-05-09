<?php

namespace App\Query;

/**
 * QueryInterface Interface
 */
interface QueryInterface
{
    public function getResult();

    // every model type must know how to order itself (by default anyway)
    public function order();
}
