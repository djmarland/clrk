<?php

namespace App\Client\Database\Entity;

use Doctrine\ORM\Mapping\ClassMetadata;

class Settings extends Entity
{

    public $active_status;
    public $application_name;

    /**
     * @codeCoverageIgnore
     * @param ClassMetadata $metadata
     */
    public static function loadMetadata(ClassMetadata $metadata)
    {
        parent::commonMetadata($metadata);

        $metadata->mapField(array(
            'fieldName' => 'active_status',
            'type' => 'integer',
            'default' => 0
        ));

        $metadata->mapField(array(
            'fieldName' => 'application_name',
            'type' => 'string'
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
