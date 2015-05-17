<?php

namespace App\Mapper\Database;

use App\Domain\Entity\User;
use App\Client\Database\Entity\User as UserEntity;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\ID;

class UserMapper extends Mapper
{
    public function getDomainModel($item)
    {
        $id = new ID($item->id);
        $email = new Email($item->email);
        $settings = new User(
            $id,
            $item->created_at,
            $item->updated_at,
            $item->name,
            $email,
            $item->password_digest,
            $item->is_admin
        );

        $settings->setOrmEntity($item);
        return $settings;
    }

    public function getOrmEntity($domain)
    {
        $entity = $domain->getOrmEntity();
        if (!$entity) {
            // create a new one
            $entity = new UserEntity;
        }

        $entity->id         = $domain->getIdValue();
        $entity->created_at = $domain->getCreatedAt();
        $entity->updated_at = $domain->getUpdatedAt();
        $entity->name       = $domain->getName();
        $entity->email      = (string) $domain->getEmail();
        $entity->is_admin   = $domain->isAdmin();
        $entity->password_digest = $domain->getPasswordDigest();

        return $entity;
    }
}
