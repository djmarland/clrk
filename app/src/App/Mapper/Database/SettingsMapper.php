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
            $item->active_status
        );
        return $settings;
    }
}
