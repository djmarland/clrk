<?php

namespace App\Query\Database;

use App\Mapper\Database\MapperFactory;
use Doctrine\ORM\EntityManager;

/**
 * Default Database query setup
 * Class Query
 * @package App\Query\Database
 */
abstract class DatabaseQuery
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

    protected function getEntity($name)
    {
        return $this->entityManager->getRepository('App\Client\Database\Entity\\' . $name);
    }

    public function getResult($data)
    {
        $data = (array) $data;

        $queryResult = new Result($data);
        $domainModels = array();
        foreach ($queryResult->getItems() as $item) {
            $domainModels[] = $this->mapperFactory->getDomainModel($item);
        }
        $queryResult->setDomainModels($domainModels);
        return $queryResult;
    }
}
