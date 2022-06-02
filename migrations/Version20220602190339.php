<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602190339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_865F80C0962F8178');
        $this->addSql('CREATE TEMPORARY TABLE __temp__duration AS SELECT id, road_id, created_at, timer FROM duration');
        $this->addSql('DROP TABLE duration');
        $this->addSql('CREATE TABLE duration (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, road_id INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , timer INTEGER NOT NULL, CONSTRAINT FK_865F80C0962F8178 FOREIGN KEY (road_id) REFERENCES road (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO duration (id, road_id, created_at, timer) SELECT id, road_id, created_at, timer FROM __temp__duration');
        $this->addSql('DROP TABLE __temp__duration');
        $this->addSql('CREATE INDEX IDX_865F80C0962F8178 ON duration (road_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_865F80C0962F8178');
        $this->addSql('CREATE TEMPORARY TABLE __temp__duration AS SELECT id, road_id, created_at, timer FROM duration');
        $this->addSql('DROP TABLE duration');
        $this->addSql('CREATE TABLE duration (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, road_id INTEGER NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , timer INTEGER NOT NULL)');
        $this->addSql('INSERT INTO duration (id, road_id, created_at, timer) SELECT id, road_id, created_at, timer FROM __temp__duration');
        $this->addSql('DROP TABLE __temp__duration');
        $this->addSql('CREATE INDEX IDX_865F80C0962F8178 ON duration (road_id)');
    }
}
