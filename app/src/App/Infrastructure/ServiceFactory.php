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

    private $services = [];

    public function __construct(
        $factories = []
    ) {
        $this->queryFactories = $factories;
    }

    public function createService($serviceName)
    {
        $className = '\App\Service\\' . $serviceName . 'Service';
        if (!isset($this->services[$className])) {
            $this->services[$className] = new $className($this->queryFactories);
        }
        return $this->services[$className];
    }
}
