<?php

namespace App\Service;

use App\Domain\Entity\User;
use App\Domain\ValueObject\ID;
use App\Domain\ValueObject\Key;

/**
 * Default factory setup
 * Class ServiceFactory
 * @package App\Infrastructure
 */
class UsersService extends Service
{
    public function getUserQuery()
    {
        return $this->getDatabaseQueryFactory()->createQuery('Users');
    }

    /**
     * @param User $user
     * @return User
     */
    public function createNewUser(User $user)
    {
        // @todo - check for unique (somewhere)

        $result = $this->getUserQuery()->insert($user);
        $user->setId(new ID($result));
        return $user;
    }

    public function findById(ID $id)
    {
        $result = $this->getUserQuery()
            ->setBy('id',(string) $id)
            ->findOne();

        if ($result) {
            // only one was expected, so just return it directly
            // rather than a full result object
            $users = $result->getDomainModels();
            return reset($users);
        }
        return null; // no such user
    }

    public function findByKey(Key $key)
    {
        $id = $key->getId();
        return $this->findById($id);
    }

    public function findByEmail($email)
    {
        $result = $this->getUserQuery()
            ->setBy('email',$email)
            ->findOne();
        if ($result) {
            // only one was expected, so just return it directly
            // rather than a full result object
            $users = $result->getDomainModels();
            return reset($users);
        }
        return null; // no such user
    }

    /**
     * @param $limit
     * @param $page
     */
    public function findAndCountLatest(
        $limit,
        $page = 1
    ) {
        $result = $this->getUserQuery()->findAndCountLatest(
            $limit,
            $page
        );
        return $result;
    }
}
