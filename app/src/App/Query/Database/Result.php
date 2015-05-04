<?php

namespace App\Query\Database;

use App\Query\QueryResultInterface;

/**
 * QueryInterface Interface
 */
class Result implements QueryResultInterface
{

    /**
     * @var
     */
    private $items;

    /**
     * @var
     */
    private $total;

    /**
     * @var
     */
    private $domainModels;

    /**
     * @param $result
     */
    public function __construct($result)
    {
        $this->items = $result;
    }

    /**
     * @param $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * @param $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @param $models
     */
    public function setDomainModels($models)
    {
        $this->domainModels = $models;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        // @todo - if no items were requested, throw an exception
        return $this->items;
    }

    /**
     * return int
     */
    public function getTotal()
    {
        // @todo - if no total was requested, throw an exception
        return $this->total;
    }

    /**
     * @return mixed
     */
    public function getDomainModels()
    {
        return $this->domainModels;
    }
}
