<?php

namespace App\Query\Database;

use Doctrine\DBAL\Exception\ConnectionException;

/**
 * Class UsersQuery
 * @package App\Query\Database
 */
class UsersQuery extends DatabaseQuery
{
    /**
     * @param $domain
     * @return mixed
     */
    public function insert($domain)
    {
        $mapper = $this->mapperFactory->getMapper($domain);

        $entity = $mapper->getOrmEntity($domain);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $entity->id;
    }

    private $by = [];

    public function setBy(
        $key,
        $value
    ) {
        $this->by[$key] = $value;
        return $this;
    }

    public function findOne()
    {
        $entity = $this->getEntity('User');

        $data = $entity->findOneBy($this->by);
        if ($data) {
            return $this->getResult($data);
        }
        return null;
    }

    public function countAll()
    {
        $entity = $this->getEntity('User');
        $qb = $entity->createQueryBuilder('user');
        $qb->select('count(user.id)');
        $count = (int) $qb->getQuery()->getSingleScalarResult();
        return $count;
    }

    public function findLatest(
        $limit,
        $page
    ) {
        $offset = $this->calculateOffset($limit, $page);
        $entity = $this->getEntity('User');

        $sort = ['created_at' => 'DESC'];

        $data = $entity->findBy(
            [],
            $sort,
            $limit,
            $offset
        );

        if (!$data) {
            $data = array();
        }
        return $this->getResult($data);
    }

    public function findAndCountLatest(
        $limit,
        $page
    ) {
        $result = $this->findLatest(
            $limit,
            $page
        );

        $total = $this->countAll();
        $result->setTotal($total);

        return $result;
    }
}
