<?php

namespace App\Service;

use Solution10\Config\Exception;

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
        throw new Exception('You tried to use a feature that needed Database, but it was not setup');
    }
}
