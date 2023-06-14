<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504122328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cat ADD human_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cat ADD CONSTRAINT FK_9E5E43A88ABD4580 FOREIGN KEY (human_id) REFERENCES human (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_9E5E43A88ABD4580 ON cat (human_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE cat DROP CONSTRAINT FK_9E5E43A88ABD4580');
        $this->addSql('DROP INDEX IDX_9E5E43A88ABD4580');
        $this->addSql('ALTER TABLE cat DROP human_id');
    }
}
