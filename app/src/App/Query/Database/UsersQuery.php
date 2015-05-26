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

    /**
     * @param $id
     * @return Result|null
     */
    public function findById($id)
    {
        $entity = $this->getEntity('User');

        $data = $entity->findOneBy(['id' => $id]);
        if ($data) {
            return $this->getResult($data);
        }
        return null;
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
            $sort
        );
        if ($data) {
            return $this->getResult($data);
        }
        return null;

        $count = $entity->findBy(
            ['count(*)']
        );
        var_dump($count);
        var_dump(get_class_methods($entity));die;
        var_dump($data);die;
    }
}
