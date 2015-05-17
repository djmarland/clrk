<?php

namespace App\Service;

/**
 * Default factory setup
 * Class ServiceFactory
 * @package App\Infrastructure
 */
class SettingsService extends Service
{
    public function get()
    {
        $query = $this->getDatabaseQueryFactory()->createQuery('Settings');
        $result = $query->get();
        if ($result === null) {
            return null; // no settings exist
        }
        return $result->getDomainModel();
    }

    public function save($settings)
    {
        $query = $this->getDatabaseQueryFactory()->createQuery('Settings');
        $result = $query->save($settings);
        return $result;
    }
}
