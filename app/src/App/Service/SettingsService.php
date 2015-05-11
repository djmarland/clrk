<?php

namespace App\Service;

use App\Query\Database\DatabaseQuery;

/**
 * Default factory setup
 * Class ServiceFactory
 * @package App\Infrastructure
 */
class SettingsService extends Service
{
    public function getAll()
    {
        $query = $this->getDatabaseQueryFactory()->createQuery('Settings');
        $result = $query->getResult();
        if ($result === null) {
            return null; // no settings exist
        }
        return $result->getDomainModel();
    }
}
