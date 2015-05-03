<?php

namespace App\Domain\Entity;

use App\Domain\Entity;
use App\Domain\ValueObject\Address;
use App\Domain\ValueObject\ID;

/**
 * Class User
 * For describe users of the system
 */
class User extends Entity
{
    const KEY_PREFIX = 'C';

    /**
     * @param ID      $id
     * @param $name
     * @param Address $address
     */
    public function __construct(
        ID $id,
        $name,
        Address $address = null
    ) {
        parent::__construct(
            $id
        );

        $this->name = $name;
        $this->address = $address;
    }

    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @var string
     */
    private $address;

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }
}
