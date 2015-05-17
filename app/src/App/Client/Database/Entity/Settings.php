<?php

namespace App\Client\Database\Entity;

/**
 * @Entity
 * @Table(name="settings")
 */
class Settings extends Entity
{
    /** @Column(type="integer") */
    public $active_status;

    /** @Column(type="string") */
    public $application_name;
}
