<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\ID;
use App\Domain\ValueObject\Key;
use DateTime;

/**
 * Class Entity
 * For those which the base object inherit
 */
abstract class Entity
{
    const KEY_PREFIX = null;

    public function __construct(
        $id,
        $createdAt,
        $updatedAt
    ) {
        if (!is_null($id) && !($id instanceof ID)) {
            throw new \InvalidArgumentException('ID must be an instance of ID (or null)');
        }

        if (!is_null($createdAt) && !($createdAt instanceof DateTime)) {
            throw new \InvalidArgumentException('CreatedAt must be an instance of DateTime (or null)');
        }

        if (!is_null($updatedAt) && !($updatedAt instanceof DateTime)) {
            throw new \InvalidArgumentException('UpdatedAt must be an instance of DateTime (or null)');
        }

        if ((is_null($createdAt) && !is_null($updatedAt)) ||
            (is_null($updatedAt) && !is_null($createdAt))) {
            throw new \InvalidArgumentException('Both CreatedAt and UpdatedAt must be set');
        }

        if (is_null($createdAt)) {
            $createdAt = new DateTime();
            $updatedAt = new DateTime();
        }

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

    /**
     * @var \App\Client\Database\Entity\Entity
     */
    private $ormEntity;

    /**
     * @param \App\Client\Database\Entity\Entity $ormEntity
     */
    public function setOrmEntity($ormEntity)
    {
        $this->ormEntity = $ormEntity;
    }

    /**
     * @return \App\Client\Database\Entity\Entity $ormEntity
     */
    public function getOrmEntity()
    {
        return $this->ormEntity;
    }

    protected $changed = false;

    protected function updated()
    {
        $this->changed = true;
        $this->updatedAt = new DateTime();
    }

    public function hasChanged()
    {
        return $this->changed;
    }
}
