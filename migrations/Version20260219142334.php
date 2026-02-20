<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260219142334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_emploie DROP FOREIGN KEY `FK_1E1DB2C8A4AEAFEA`');
        $this->addSql('DROP INDEX IDX_1E1DB2C8A4AEAFEA ON offre_emploie');
        $this->addSql('ALTER TABLE offre_emploie DROP entreprise_id');
        $this->addSql('ALTER TABLE type_emploie DROP FOREIGN KEY `FK_9AE7AE1D4C08A235`');
        $this->addSql('DROP INDEX IDX_9AE7AE1D4C08A235 ON type_emploie');
        $this->addSql('ALTER TABLE type_emploie DROP offre_emploie_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_emploie ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre_emploie ADD CONSTRAINT `FK_1E1DB2C8A4AEAFEA` FOREIGN KEY (entreprise_id) REFERENCES entreprise (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1E1DB2C8A4AEAFEA ON offre_emploie (entreprise_id)');
        $this->addSql('ALTER TABLE type_emploie ADD offre_emploie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_emploie ADD CONSTRAINT `FK_9AE7AE1D4C08A235` FOREIGN KEY (offre_emploie_id) REFERENCES offre_emploie (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_9AE7AE1D4C08A235 ON type_emploie (offre_emploie_id)');
    }
}
