<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210624094342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE season DROP CONSTRAINT fk_f0e45ba97b39d312');
        $this->addSql('DROP INDEX uniq_f0e45ba97b39d312');
        $this->addSql('ALTER TABLE season DROP competition_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE season ADD competition_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE season ADD CONSTRAINT fk_f0e45ba97b39d312 FOREIGN KEY (competition_id) REFERENCES competition (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_f0e45ba97b39d312 ON season (competition_id)');
    }
}
