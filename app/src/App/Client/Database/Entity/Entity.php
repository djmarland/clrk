<?php

namespace App\Client\Database\Entity;

use Doctrine\ORM\Mapping\ClassMetadata;

class Entity
{

    public $id;
    public $updated_at;
    public $created_at;

    /**
     * @codeCoverageIgnore
     * @param ClassMetadata $metadata
     */
    public static function commonMetadata(ClassMetadata $metadata)
    {
        $metadata->mapField(array(
            'id' => true,
            'fieldName' => 'id',
            'type' => 'integer',
            'primaryKey' => true,
            'autoIncrement' => true
        ));

        $metadata->mapField(array(
            'fieldName' => 'created_at',
            'type' => 'datetime'
        ));

        $metadata->mapField(array(
            'fieldName' => 'updated_at',
            'type' => 'datetime'
        ));
    }
}
