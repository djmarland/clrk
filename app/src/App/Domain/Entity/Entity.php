<?php

namespace App\Domain\Entity;

use App\Domain\ValueObject\ID;

/**
 * Class Entity
 * For those which the base object inherit
 */
abstract class Entity
{
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
     * @return string
     */
    public function getKey()
    {
        // @todo - convert ID to KEY
    }
}
