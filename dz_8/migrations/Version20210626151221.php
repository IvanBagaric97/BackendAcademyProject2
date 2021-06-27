<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210626151221 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_e0d53baaac78bcf8');
        $this->addSql('CREATE INDEX IDX_E0D53BAAAC78BCF8 ON competitor (sport_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX IDX_E0D53BAAAC78BCF8');
        $this->addSql('CREATE UNIQUE INDEX uniq_e0d53baaac78bcf8 ON competitor (sport_id)');
    }
}
