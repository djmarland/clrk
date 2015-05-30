<?php

namespace App\Service;

use App\Domain\Exception\DataNotSetException;
use App\Query\DatabaseQueryFactory;
use App\Query\EmailQueryFactory;

/**
 * Default factory setup
 * Class ServiceFactory
 * @package App\Infrastructure
 */
abstract class Service
{

    const FACTORY_DATABASE = 'Database';

    const FACTORY_EMAIL = 'Email';

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

    /**
     * @return DatabaseQueryFactory
     * @throws DataNotSetException
     */
    public function getDatabaseQueryFactory()
    {
        if (isset($this->factories[self::FACTORY_DATABASE])) {
            return $this->factories[self::FACTORY_DATABASE];
        }
        throw new DataNotSetException(
            'You tried to use a feature that needed a Database factory, but it was not setup'
        );
    }

    /**
     * @return EmailQueryFactory
     * @throws DataNotSetException
     */
    public function getEmailQueryFactory()
    {
        if (isset($this->factories[self::FACTORY_EMAIL])) {
            return $this->factories[self::FACTORY_EMAIL];
        }
        throw new DataNotSetException(
            'You tried to use a feature that needed an Email factory, but it was not setup'
        );
    }
}
