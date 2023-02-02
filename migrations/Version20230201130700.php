<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230201130700 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE upload ADD uploaded_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE upload ADD CONSTRAINT FK_17BDE61FA2B28FE8 FOREIGN KEY (uploaded_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_17BDE61FA2B28FE8 ON upload (uploaded_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE upload DROP CONSTRAINT FK_17BDE61FA2B28FE8');
        $this->addSql('DROP INDEX IDX_17BDE61FA2B28FE8');
        $this->addSql('ALTER TABLE upload DROP uploaded_by_id');
    }
}
