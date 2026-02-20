<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260219165830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appel ADD collaboration_id INT NOT NULL');
        $this->addSql('ALTER TABLE appel ADD CONSTRAINT FK_130D3BDEF1544CE FOREIGN KEY (collaboration_id) REFERENCES collaboration (id)');
        $this->addSql('CREATE INDEX IDX_130D3BDEF1544CE ON appel (collaboration_id)');
        $this->addSql('ALTER TABLE collaboration ADD entreprise1_id INT NOT NULL, ADD entreprise2_id INT NOT NULL');
        $this->addSql('ALTER TABLE collaboration ADD CONSTRAINT FK_DA3AE3239617885A FOREIGN KEY (entreprise1_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE collaboration ADD CONSTRAINT FK_DA3AE32384A227B4 FOREIGN KEY (entreprise2_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_DA3AE3239617885A ON collaboration (entreprise1_id)');
        $this->addSql('CREATE INDEX IDX_DA3AE32384A227B4 ON collaboration (entreprise2_id)');
        $this->addSql('ALTER TABLE finalite ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE finalite ADD CONSTRAINT FK_BB59DE85A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_BB59DE85A4AEAFEA ON finalite (entreprise_id)');
        $this->addSql('ALTER TABLE message ADD collaboration_id INT NOT NULL');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FEF1544CE FOREIGN KEY (collaboration_id) REFERENCES collaboration (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FEF1544CE ON message (collaboration_id)');
        $this->addSql('ALTER TABLE proposition_banque ADD collaboration_id INT NOT NULL, ADD banque_id INT NOT NULL');
        $this->addSql('ALTER TABLE proposition_banque ADD CONSTRAINT FK_379B495AEF1544CE FOREIGN KEY (collaboration_id) REFERENCES collaboration (id)');
        $this->addSql('ALTER TABLE proposition_banque ADD CONSTRAINT FK_379B495A37E080D9 FOREIGN KEY (banque_id) REFERENCES banque (id)');
        $this->addSql('CREATE INDEX IDX_379B495AEF1544CE ON proposition_banque (collaboration_id)');
        $this->addSql('CREATE INDEX IDX_379B495A37E080D9 ON proposition_banque (banque_id)');
        $this->addSql('ALTER TABLE rencontre ADD collaboration_id INT NOT NULL, ADD lieu_id INT NOT NULL');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35EDEF1544CE FOREIGN KEY (collaboration_id) REFERENCES collaboration (id)');
        $this->addSql('ALTER TABLE rencontre ADD CONSTRAINT FK_460C35ED6AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id)');
        $this->addSql('CREATE INDEX IDX_460C35EDEF1544CE ON rencontre (collaboration_id)');
        $this->addSql('CREATE INDEX IDX_460C35ED6AB213CC ON rencontre (lieu_id)');
        $this->addSql('ALTER TABLE ressource ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE ressource ADD CONSTRAINT FK_939F4544A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_939F4544A4AEAFEA ON ressource (entreprise_id)');
        $this->addSql('ALTER TABLE secteur ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE secteur ADD CONSTRAINT FK_8045251FA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_8045251FA4AEAFEA ON secteur (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appel DROP FOREIGN KEY FK_130D3BDEF1544CE');
        $this->addSql('DROP INDEX IDX_130D3BDEF1544CE ON appel');
        $this->addSql('ALTER TABLE appel DROP collaboration_id');
        $this->addSql('ALTER TABLE collaboration DROP FOREIGN KEY FK_DA3AE3239617885A');
        $this->addSql('ALTER TABLE collaboration DROP FOREIGN KEY FK_DA3AE32384A227B4');
        $this->addSql('DROP INDEX IDX_DA3AE3239617885A ON collaboration');
        $this->addSql('DROP INDEX IDX_DA3AE32384A227B4 ON collaboration');
        $this->addSql('ALTER TABLE collaboration DROP entreprise1_id, DROP entreprise2_id');
        $this->addSql('ALTER TABLE finalite DROP FOREIGN KEY FK_BB59DE85A4AEAFEA');
        $this->addSql('DROP INDEX IDX_BB59DE85A4AEAFEA ON finalite');
        $this->addSql('ALTER TABLE finalite DROP entreprise_id');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FEF1544CE');
        $this->addSql('DROP INDEX IDX_B6BD307FEF1544CE ON message');
        $this->addSql('ALTER TABLE message DROP collaboration_id');
        $this->addSql('ALTER TABLE proposition_banque DROP FOREIGN KEY FK_379B495AEF1544CE');
        $this->addSql('ALTER TABLE proposition_banque DROP FOREIGN KEY FK_379B495A37E080D9');
        $this->addSql('DROP INDEX IDX_379B495AEF1544CE ON proposition_banque');
        $this->addSql('DROP INDEX IDX_379B495A37E080D9 ON proposition_banque');
        $this->addSql('ALTER TABLE proposition_banque DROP collaboration_id, DROP banque_id');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35EDEF1544CE');
        $this->addSql('ALTER TABLE rencontre DROP FOREIGN KEY FK_460C35ED6AB213CC');
        $this->addSql('DROP INDEX IDX_460C35EDEF1544CE ON rencontre');
        $this->addSql('DROP INDEX IDX_460C35ED6AB213CC ON rencontre');
        $this->addSql('ALTER TABLE rencontre DROP collaboration_id, DROP lieu_id');
        $this->addSql('ALTER TABLE ressource DROP FOREIGN KEY FK_939F4544A4AEAFEA');
        $this->addSql('DROP INDEX IDX_939F4544A4AEAFEA ON ressource');
        $this->addSql('ALTER TABLE ressource DROP entreprise_id');
        $this->addSql('ALTER TABLE secteur DROP FOREIGN KEY FK_8045251FA4AEAFEA');
        $this->addSql('DROP INDEX IDX_8045251FA4AEAFEA ON secteur');
        $this->addSql('ALTER TABLE secteur DROP entreprise_id');
    }
}
