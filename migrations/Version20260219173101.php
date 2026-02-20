<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260219173101 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise ADD statut_id INT NOT NULL, ADD taille_id INT NOT NULL, ADD secteur_activite_id INT NOT NULL');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60F6203804 FOREIGN KEY (statut_id) REFERENCES statut_entreprise (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA60FF25611A FOREIGN KEY (taille_id) REFERENCES taille_entreprise (id)');
        $this->addSql('ALTER TABLE entreprise ADD CONSTRAINT FK_D19FA605233A7FC FOREIGN KEY (secteur_activite_id) REFERENCES secteur_activite (id)');
        $this->addSql('CREATE INDEX IDX_D19FA60F6203804 ON entreprise (statut_id)');
        $this->addSql('CREATE INDEX IDX_D19FA60FF25611A ON entreprise (taille_id)');
        $this->addSql('CREATE INDEX IDX_D19FA605233A7FC ON entreprise (secteur_activite_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60F6203804');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA60FF25611A');
        $this->addSql('ALTER TABLE entreprise DROP FOREIGN KEY FK_D19FA605233A7FC');
        $this->addSql('DROP INDEX IDX_D19FA60F6203804 ON entreprise');
        $this->addSql('DROP INDEX IDX_D19FA60FF25611A ON entreprise');
        $this->addSql('DROP INDEX IDX_D19FA605233A7FC ON entreprise');
        $this->addSql('ALTER TABLE entreprise DROP statut_id, DROP taille_id, DROP secteur_activite_id');
    }
}
