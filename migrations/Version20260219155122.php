<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260219155122 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demande_offre (id INT AUTO_INCREMENT NOT NULL, demandeur_emploie_id INT NOT NULL, offre_emploie_id INT NOT NULL, INDEX IDX_595805464D6E229 (demandeur_emploie_id), INDEX IDX_595805464C08A235 (offre_emploie_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8');
        $this->addSql('CREATE TABLE demandeur_competence (id INT AUTO_INCREMENT NOT NULL, demandeur_emploie_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_F1544F464D6E229 (demandeur_emploie_id), INDEX IDX_F1544F4615761DAB (competence_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8');
        $this->addSql('ALTER TABLE demande_offre ADD CONSTRAINT FK_595805464D6E229 FOREIGN KEY (demandeur_emploie_id) REFERENCES demandeur_emploie (id)');
        $this->addSql('ALTER TABLE demande_offre ADD CONSTRAINT FK_595805464C08A235 FOREIGN KEY (offre_emploie_id) REFERENCES offre_emploie (id)');
        $this->addSql('ALTER TABLE demandeur_competence ADD CONSTRAINT FK_F1544F464D6E229 FOREIGN KEY (demandeur_emploie_id) REFERENCES demandeur_emploie (id)');
        $this->addSql('ALTER TABLE demandeur_competence ADD CONSTRAINT FK_F1544F4615761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
        $this->addSql('ALTER TABLE experience ADD type_emploie_id INT NOT NULL, ADD demandeur_emploie_id INT NOT NULL');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C1037C551335 FOREIGN KEY (type_emploie_id) REFERENCES type_emploie (id)');
        $this->addSql('ALTER TABLE experience ADD CONSTRAINT FK_590C1034D6E229 FOREIGN KEY (demandeur_emploie_id) REFERENCES demandeur_emploie (id)');
        $this->addSql('CREATE INDEX IDX_590C1037C551335 ON experience (type_emploie_id)');
        $this->addSql('CREATE INDEX IDX_590C1034D6E229 ON experience (demandeur_emploie_id)');
        $this->addSql('ALTER TABLE formation ADD demandeur_emploie_id INT NOT NULL');
        $this->addSql('ALTER TABLE formation ADD CONSTRAINT FK_404021BF4D6E229 FOREIGN KEY (demandeur_emploie_id) REFERENCES demandeur_emploie (id)');
        $this->addSql('CREATE INDEX IDX_404021BF4D6E229 ON formation (demandeur_emploie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_offre DROP FOREIGN KEY FK_595805464D6E229');
        $this->addSql('ALTER TABLE demande_offre DROP FOREIGN KEY FK_595805464C08A235');
        $this->addSql('ALTER TABLE demandeur_competence DROP FOREIGN KEY FK_F1544F464D6E229');
        $this->addSql('ALTER TABLE demandeur_competence DROP FOREIGN KEY FK_F1544F4615761DAB');
        $this->addSql('DROP TABLE demande_offre');
        $this->addSql('DROP TABLE demandeur_competence');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C1037C551335');
        $this->addSql('ALTER TABLE experience DROP FOREIGN KEY FK_590C1034D6E229');
        $this->addSql('DROP INDEX IDX_590C1037C551335 ON experience');
        $this->addSql('DROP INDEX IDX_590C1034D6E229 ON experience');
        $this->addSql('ALTER TABLE experience DROP type_emploie_id, DROP demandeur_emploie_id');
        $this->addSql('ALTER TABLE formation DROP FOREIGN KEY FK_404021BF4D6E229');
        $this->addSql('DROP INDEX IDX_404021BF4D6E229 ON formation');
        $this->addSql('ALTER TABLE formation DROP demandeur_emploie_id');
    }
}
