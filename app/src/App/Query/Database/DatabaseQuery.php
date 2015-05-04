<?php

namespace App\Query\Database;

use App\Query\QueryInterface;

/**
 * Default Database query setup
 * Class Query
 * @package App\Query\Database
 */
abstract class DatabaseQuery implements QueryInterface
{

    /**
     * The standard pagesize to use if none were set
     */
    const DEFAULT_PAGESIZE = 20;

    /**
     * The standard page to use if none were set
     */
    const DEFAULT_PAGE     = 1;

    /**
     * @var
     */
    protected $dbClient;

    /**
     * @var
     */
    protected $mapperFactory;

    /**
     * @param $dbClient
     * @param $mapperFactory
     */
    public function __construct(
        $dbClient,
        $mapperFactory
    ) {
        $this->dbClient = $dbClient;
        $this->mapperFactory = $mapperFactory;
    }

    /**
     * @param $page
     * @param $pageSize
     * @return $this
     */
    public function setPagination(
        $page,
        $pageSize
    ) {
        $this->dbClient->setLimit($pageSize);
        $offset = ($page-1) * $pageSize;
        $this->dbClient->setOffset($offset);
        return $this;
    }

    /**
     * @param $sort
     * @return $this
     */
    public function setSort($sort)
    {
        $this->dbClient->setSort($sort);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        $queryResult = $this->dbClient->getResult();
        $domainModels = array();
        foreach ($queryResult->getItems() as $item) {
            $domainModels[] = $this->mapperFactory->getDomainModel($item);
        }
        $queryResult->setDomainModels($domainModels);
        return $queryResult;
    }
}
