<?php

namespace App\Mapper\Database;

/**
 * Factory to create mappers as needed
 */
class MapperFactory
{

    public function __construct()
    {
    }

    public function getDomainModel($item)
    {
        // decide which mapper is needed based on the incoming data
        // this needs to be able to recognise data, and sub data achieved through joins
        $type = 'customer'; // hack. of course they're not all customers

        $domain = null;

        if ($type == 'customer') {
            return $this->createCustomer($item);
        }
    }

    public function createCustomer($data)
    {
        $customerMapper = new CustomerMapper($this);
        $domain = $customerMapper->getDomainModel($data);
        return $domain;
    }

    public function createSettings($data)
    {
        $settingsMapper = new SettingsMapper($this);
        $domain = $settingsMapper->getDomainModel($data);
        return $domain;
    }
}
