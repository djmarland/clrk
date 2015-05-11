<?php

namespace App\Mapper\Database;

use App\Mapper\MapperInterface;

/**
 * Factory to create mappers as needed
 */
abstract class Mapper implements MapperInterface
{
    protected $mapperFactory;

    public function __construct(
        MapperFactory $mapperFactory
    ) {
        $this->mapperFactory = $mapperFactory;
    }
}
