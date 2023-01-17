<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use LaravelDoctrine\Migrations\Schema\Table;
use LaravelDoctrine\Migrations\Schema\Builder;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230117143920 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Users table migration';
    }

    public function up(Schema $schema): void
    {
        (new Builder($schema))->create('users', function (Table $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');

            $table->unique(['email']);
        });
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE users');

    }
}
