<?php

namespace App\Client\Database\Entity;

use Doctrine\ORM\Mapping\ClassMetadata;

class Settings
{

    public $id;
    public $active_status;

    /**
     * @codeCoverageIgnore
     * @param ClassMetadata $metadata
     */
    public static function loadMetadata(ClassMetadata $metadata)
    {
        $metadata->mapField(array(
            'id' => true,
            'fieldName' => 'id',
            'type' => 'integer',
            'primaryKey' => true,
            'autoIncrement' => true
        ));

        $metadata->mapField(array(
            'fieldName' => 'active_status',
            'type' => 'integer',
            'default' => 0
        ));
    }


    /*
    public function getResult()
    {
        $sql = "SELECT * FROM settings";

        try {
            $data = $this->connection->query($sql);
        } catch (ConnectionException $e) {
            // if the connection failed due to no database
            return null;
        }

        var_dump($data->fetch());
        while ($row = $data->fetch()) {
            var_dump($row);
        }

        var_dump($data);die;
        return new Result([
            [
                'id' => 1,
                'activeStatus' => 1
            ]
        ]);
    }
    */
}
