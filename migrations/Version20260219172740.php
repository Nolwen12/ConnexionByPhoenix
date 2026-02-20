<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260219172740 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise DROP secteur_activite, DROP statut, DROP taille');
        $this->addSql('ALTER TABLE lieu ADD type_lieu_id INT NOT NULL, DROP nom');
        $this->addSql('ALTER TABLE lieu ADD CONSTRAINT FK_2F577D5942937C39 FOREIGN KEY (type_lieu_id) REFERENCES type_lieu (id)');
        $this->addSql('CREATE INDEX IDX_2F577D5942937C39 ON lieu (type_lieu_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise ADD secteur_activite VARCHAR(255) NOT NULL, ADD statut VARCHAR(255) NOT NULL, ADD taille VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE lieu DROP FOREIGN KEY FK_2F577D5942937C39');
        $this->addSql('DROP INDEX IDX_2F577D5942937C39 ON lieu');
        $this->addSql('ALTER TABLE lieu ADD nom VARCHAR(255) NOT NULL, DROP type_lieu_id');
    }
}
