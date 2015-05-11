<?php

namespace App\Query\Database;

use App\Client\Database\DatabaseClientInterface;
use App\Mapper\Database\MapperFactory;
use App\Query\QueryInterface;
use Doctrine\ORM\EntityManager;

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
    protected $entityManager;

    /**
     * @var
     */
    protected $mapperFactory;

    /**
     * @param EntityManager $entityManager
     * @param MapperFactory $mapperFactory
     */
    public function __construct(
        EntityManager $entityManager,
        MapperFactory $mapperFactory
    ) {
        $this->entityManager = $entityManager;
        $this->mapperFactory = $mapperFactory;
    }

    /**
     * @param $pageSize
     * @param $page
     * @return $this
     */
    public function setPagination(
        $pageSize,
        $page
    ) {
        $this->dbClient->setLimit($pageSize);
        $offset = ($page-1) * $pageSize;
        $this->dbClient->setOffset($offset);
        return $this;
    }

    /**
     * @param $sort
     * @param string $direction
     * @return $this
     */
    public function sortBy($sort, $direction = 'ASC')
    {
        $direction = strtoupper($direction);
        if (!in_array($direction, [
            'ASC', 'DESC'
        ])) {
            throw new \InvalidArgumentException('Invalid sort direction. Should be ASC or DESC');
        }

        // @todo validate direction
        $sort = $sort . ' ' . $direction;
        $this->dbClient->setSort($sort);
        return $this;
    }

    protected function getEntity($name)
    {
        return $this->entityManager->getRepository('App\Client\Database\Entity\\' . $name );
    }

    /**
     * @return mixed
     *
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
     */
}
