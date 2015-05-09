<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\ID;
use App\Domain\ValueObject\Key;

/**
 * Class Entity
 * For those which the base object inherit
 */
abstract class Entity
{
    const KEY_PREFIX = null;

    public function __construct(
        ID $id
    ) {
        $this->id = $id;
    }

    /**
     * @var string
     */
    private $id;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Key
     */
    public function getKey()
    {
        return new Key($this->id, static::KEY_PREFIX);
    }

}
