<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127104735 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B95CAA23C7');
        $this->addSql('DROP INDEX IDX_F804D3B95CAA23C7 ON employe');
        $this->addSql('ALTER TABLE employe CHANGE idLieu idLO INT NOT NULL');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B9921B5861 FOREIGN KEY (idLO) REFERENCES lieu (id)');
        $this->addSql('CREATE INDEX IDX_F804D3B9921B5861 ON employe (idLO)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE employe DROP FOREIGN KEY FK_F804D3B9921B5861');
        $this->addSql('DROP INDEX IDX_F804D3B9921B5861 ON employe');
        $this->addSql('ALTER TABLE employe CHANGE idLO idLieu INT NOT NULL');
        $this->addSql('ALTER TABLE employe ADD CONSTRAINT FK_F804D3B95CAA23C7 FOREIGN KEY (idLieu) REFERENCES lieu (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_F804D3B95CAA23C7 ON employe (idLieu)');
    }
}
