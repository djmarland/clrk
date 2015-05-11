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
        $result = $query->getResult();
        if ($result === null) {
            return null; // no settings exist
        }
        return $result->getDomainModel();
    }
}
