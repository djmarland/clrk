<?php

namespace App\Infrastructure;

/**
 * Default factory setup
 * Class ServiceFactory
 * @package App\Infrastructure
 */
class ServiceFactory
{

    private $queryFactories;

    public function __construct(
        $factories = []
    ) {
        $this->queryFactories = $factories;
    }

    public function createService($serviceName)
    {
        $className = '\App\Service\\' . $serviceName . 'Service';
        return new $className($this->queryFactories);
    }
}
