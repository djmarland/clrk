<?php

namespace App\Query\Database;

use Doctrine\DBAL\Exception\ConnectionException;

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
    public function get()
    {
        $settings = $this->getEntity('Settings');

        try {
            $data = $settings->findOneBy(['id' => '1']);
        } catch (ConnectionException $e) {
            // if the connection failed due to no database
            return null;
        }

        return parent::getResult($data);
    }
}
