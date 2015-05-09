<?php
namespace App\Mapper;

use stdClass;

/**
 * Interface MapperInterface
 */
interface MapperInterface
{
    public function getDomainModel($dataObject);
}
