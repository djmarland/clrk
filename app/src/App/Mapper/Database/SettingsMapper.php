<?php

namespace App\Mapper\Database;

use App\Domain\Entity\Settings;
use App\Domain\ValueObject\ID;

class SettingsMapper extends Mapper
{
    public function getDomainModel($item)
    {
        $id = new ID($item->id);
        $settings = new Settings(
            $id,
            $item->created_at,
            $item->updated_at,
            $item->active_status,
            $item->application_name
        );

        $settings->setOrmEntity($item);
        return $settings;
    }

    public function getOrmEntity($domain)
    {
        $entity = $domain->getOrmEntity();
        // @todo
        if (!$entity) {
            // create a new one
        }
        $entity->id = 1; // must always be 1 (only one row allowed)
        $entity->application_name = $domain->getApplicationName();
        return $entity;
    }
}
