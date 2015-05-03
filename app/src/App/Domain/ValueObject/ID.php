<?php

namespace App\Domain\ValueObject;

/**
 * Class ID
 * For handling Identifiers
 */
class ID
{

    /**
     * @param $id
     */
    public function __construct(
        $id
    ) {
        $this->id = $id; // @todo - validate
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

    public function __toString()
    {
        return $this->getId();
    }
}
