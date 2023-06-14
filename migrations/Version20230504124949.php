<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504124949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cat_property (cat_id INT NOT NULL, property_id INT NOT NULL, PRIMARY KEY(cat_id, property_id))');
        $this->addSql('CREATE INDEX IDX_9DA599DE6ADA943 ON cat_property (cat_id)');
        $this->addSql('CREATE INDEX IDX_9DA599D549213EC ON cat_property (property_id)');
        $this->addSql('CREATE TABLE human_property (human_id INT NOT NULL, property_id INT NOT NULL, PRIMARY KEY(human_id, property_id))');
        $this->addSql('CREATE INDEX IDX_62567A828ABD4580 ON human_property (human_id)');
        $this->addSql('CREATE INDEX IDX_62567A82549213EC ON human_property (property_id)');
        $this->addSql('ALTER TABLE cat_property ADD CONSTRAINT FK_9DA599DE6ADA943 FOREIGN KEY (cat_id) REFERENCES cat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE cat_property ADD CONSTRAINT FK_9DA599D549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE human_property ADD CONSTRAINT FK_62567A828ABD4580 FOREIGN KEY (human_id) REFERENCES human (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE human_property ADD CONSTRAINT FK_62567A82549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE cat_property DROP CONSTRAINT FK_9DA599DE6ADA943');
        $this->addSql('ALTER TABLE cat_property DROP CONSTRAINT FK_9DA599D549213EC');
        $this->addSql('ALTER TABLE human_property DROP CONSTRAINT FK_62567A828ABD4580');
        $this->addSql('ALTER TABLE human_property DROP CONSTRAINT FK_62567A82549213EC');
        $this->addSql('DROP TABLE cat_property');
        $this->addSql('DROP TABLE human_property');
    }
}
