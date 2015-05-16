<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\ID;

/**
 * Class User
 * For describe users of the system
 */
class Settings extends Entity
{

    const STATUS_INACTIVE = 0;

    const STATUS_SUSPENDED = -1;

    const STATUS_ACTIVE = 1;

    /**
     * @param ID $id
     * @param $createdAt
     * @param $updatedAt
     * @param $activeStatus
     */
    public function __construct(
        ID $id,
        $createdAt,
        $updatedAt,
        $activeStatus
    ) {
        parent::__construct(
            $id,
            $createdAt,
            $updatedAt
        );

        $this->activeStatus = $activeStatus;
    }

    /**
     * @var string
     */
    private $activeStatus;

    /**
     * @return string
     */
    public function getActiveStatus()
    {
        return $this->activeStatus;
    }

    public function isActive()
    {
        return ($this->activeStatus == self::STATUS_ACTIVE);
    }

    public function isSuspended()
    {
        return ($this->activeStatus == self::STATUS_SUSPENDED);
    }
}
