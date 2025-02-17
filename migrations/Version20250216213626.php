<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250216213626 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statement (id SERIAL NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, number VARCHAR(255) DEFAULT NULL, insert_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, file_id INT DEFAULT NULL, description VARCHAR(2000) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C0DB51767E3C61F9 ON statement (owner_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, phone VARCHAR(15) NOT NULL, birthday TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, address VARCHAR(255) NOT NULL, insert_date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649444F97DD ON "user" (phone)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)');
        $this->addSql('ALTER TABLE statement ADD CONSTRAINT FK_C0DB51767E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE statement DROP CONSTRAINT FK_C0DB51767E3C61F9');
        $this->addSql('DROP TABLE statement');
        $this->addSql('DROP TABLE "user"');
    }
}
