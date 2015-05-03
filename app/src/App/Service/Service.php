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


    public function getMySQLQueryFactory()
    {
        if (isset($this->factories['MySQL'])) {
            return $this->factories['MySQL'];
        }
        // @todo - be cleaner about this (custom exception)
        throw new Exception('You tried to use a feature that needed MySQL, but it was not setup');
    }
}
