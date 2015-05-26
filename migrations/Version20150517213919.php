<?php

namespace Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20150517213919 extends AbstractMigration
{
    const TABLE_NAME = 'users';

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

        $table->addColumn('name', 'string', [
            'notnull' => true
        ]);

        $table->addColumn('email', 'string', [
            'notnull' => true
        ]);

        $table->addColumn('password_digest', 'string', [
            'notnull' => true
        ]);

        $table->addColumn('password_expired', 'boolean', [
            'default' => false
        ]);

        $table->addColumn('is_admin', 'boolean', [
            'default' => false
        ]);
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $schema->dropTable(self::TABLE_NAME);
    }
}
