<?php

namespace App\Service;

use App\Domain\Exception\DataNotSetException;

/**
 * Default factory setup
 * Class ServiceFactory
 * @package App\Infrastructure
 */
abstract class Service
{

    const FACTORY_DATABASE = 'Database';

    /**
     * @var
     */
    private $factories;

    /**
     * @param $factories
     */
    public function __construct(
        $factories = []
    ) {
        $this->factories = $factories;
    }


    public function getDatabaseQueryFactory()
    {
        if (isset($this->factories[self::FACTORY_DATABASE])) {
            return $this->factories[self::FACTORY_DATABASE];
        }
        // @todo - be cleaner about this (custom exception)
        throw new DataNotSetException(
            'You tried to use a feature that needed a Database factory, but it was not setup'
        );
    }
}
