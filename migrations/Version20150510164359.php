<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20150510164359 extends AbstractMigration
{
    const TABLE_NAME = 'Settings';

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

        $table->addColumn('active_status', 'integer', [
            'notnull' => true,
            'default'  => 0
        ]);

        $table->addColumn('created_at', 'datetime', [
            'notnull' => true
        ]);

        $table->addColumn('updated_at', 'datetime', [
            'notnull' => true
        ]);
        $table->setPrimaryKey(['id']);
    }

    public function postUp(Schema $schema) {
        $this->connection->executeQuery(
            "INSERT INTO " . self::TABLE_NAME ."
              (active_status, created_at, updated_at)
              VALUES (0, now(), now())"
        );
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema->dropTable('settings');
    }
}
