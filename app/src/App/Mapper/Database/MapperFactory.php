<?php

namespace App\Mapper\Database;

use App\Client\Database\Entity\Settings as SettingsOrm;
use App\Domain\Entity\Settings;

/**
 * Factory to create mappers as needed
 */
class MapperFactory
{

    public function __construct()
    {
    }

    public function getMapper($item)
    {
        // decide which mapper is needed based on the incoming data
        // this needs to be able to recognise data, and sub data achieved through joins
        if ($item instanceof SettingsOrm ||
            $item instanceof Settings) {
            return $this->createSettings();
        }


        $type = 'customer'; // hack. of course they're not all customers

        $domain = null;

        if ($type == 'customer') {
            return $this->createCustomer();
        }
    }

    public function createCustomer()
    {
        $customerMapper = new CustomerMapper($this);
        $domain = $customerMapper->getDomainModel($data);
        return $domain;
    }

    public function createSettings()
    {
        $settingsMapper = new SettingsMapper($this);
        return $settingsMapper;
    }
}
