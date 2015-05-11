<?php

namespace App\Query\Database;

/**
 * Customers table
 * Class SettingsQuery
 * @package App\Query\Database
 */
class SettingsQuery extends DatabaseQuery
{
    /**
     * @return $this
     */
    public function order()
    {
        $this->sortBy('id');
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        $settings = $this->getEntity('Settings');

        var_dump($settings->findOneBy(['id' => '1']));die;
        // only one possible result type
        var_dump($settings);die;

        $queryResult = $this->dbClient->getResult();
        if ($queryResult === null) {
            return null;
        }

        $domainModels = array();
        foreach ($queryResult->getItems() as $item) {
            $domainModels[] = $this->mapperFactory->createSettings($item);
        }
        $queryResult->setDomainModels($domainModels);
        return $queryResult;
    }
}
