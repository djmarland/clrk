<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20150510164359 extends AbstractMigration
{
    const TABLE_NAME = 'settings';

    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // Create the initial Settings table
        $table = $schema->createTable(self::TABLE_NAME);
        $table->addColumn('id', 'integer', [
            'unsigned' => true,
            'autoincrement' => true,
            'notnull' => true
        ]);
        $table->setPrimaryKey(['id']);

        $table->addColumn('created_at', 'datetime', [
            'notnull' => true
        ]);

        $table->addColumn('updated_at', 'datetime', [
            'notnull' => true
        ]);

        $table->addColumn('active_status', 'integer', [
            'notnull' => true,
            'default'  => 0
        ]);


        $table->addColumn('application_name', 'string', [
            'notnull' => true
        ]);
    }

    public function postUp(Schema $schema) {
        // populate the first and only row
        $this->connection->executeQuery(
            'INSERT INTO ' . self::TABLE_NAME . '
              (active_status, application_name, created_at, updated_at)
              VALUES (0, "Application", now(), now())'
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema->dropTable(self::TABLE_NAME);
    }
}
