<?php

namespace App\Client\Database;

use App\Query\Database\Result;
use Doctrine\DBAL\Exception\ConnectionException;

/**
 * Class SQLClient
 */
class SettingsTable extends DatabaseClient
{
    const TABLE_NAME = 'settings';

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
            'fieldName' => 'activeStatus',
            'type' => 'integer',
            'default' => 0
        ));
    }


    /**
     * @return Result
     */
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
}
