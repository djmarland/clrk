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
        ID $id,
        $createdAt,
        $updatedAt
    ) {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
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
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    private $key;

    /**
     * @return Key
     */
    public function getKey()
    {
        if (!$this->key) {
            $this->key = new Key($this->id, static::KEY_PREFIX);
        }
        return $this->key;
    }
}
