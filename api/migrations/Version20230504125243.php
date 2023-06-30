<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504125243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE proposal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE proposal (id INT NOT NULL, cat_id INT DEFAULT NULL, human_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BFE59472E6ADA943 ON proposal (cat_id)');
        $this->addSql('CREATE INDEX IDX_BFE594728ABD4580 ON proposal (human_id)');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE59472E6ADA943 FOREIGN KEY (cat_id) REFERENCES cat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE proposal ADD CONSTRAINT FK_BFE594728ABD4580 FOREIGN KEY (human_id) REFERENCES human (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE proposal_id_seq CASCADE');
        $this->addSql('ALTER TABLE proposal DROP CONSTRAINT FK_BFE59472E6ADA943');
        $this->addSql('ALTER TABLE proposal DROP CONSTRAINT FK_BFE594728ABD4580');
        $this->addSql('DROP TABLE proposal');
    }
}
