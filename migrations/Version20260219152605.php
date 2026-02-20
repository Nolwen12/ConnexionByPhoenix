<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260219152605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_emploie ADD type_emploie_id INT DEFAULT NULL, ADD entreprise_id INT NOT NULL');
        $this->addSql('ALTER TABLE offre_emploie ADD CONSTRAINT FK_1E1DB2C87C551335 FOREIGN KEY (type_emploie_id) REFERENCES type_emploie (id)');
        $this->addSql('ALTER TABLE offre_emploie ADD CONSTRAINT FK_1E1DB2C8A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('CREATE INDEX IDX_1E1DB2C87C551335 ON offre_emploie (type_emploie_id)');
        $this->addSql('CREATE INDEX IDX_1E1DB2C8A4AEAFEA ON offre_emploie (entreprise_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offre_emploie DROP FOREIGN KEY FK_1E1DB2C87C551335');
        $this->addSql('ALTER TABLE offre_emploie DROP FOREIGN KEY FK_1E1DB2C8A4AEAFEA');
        $this->addSql('DROP INDEX IDX_1E1DB2C87C551335 ON offre_emploie');
        $this->addSql('DROP INDEX IDX_1E1DB2C8A4AEAFEA ON offre_emploie');
        $this->addSql('ALTER TABLE offre_emploie DROP type_emploie_id, DROP entreprise_id');
    }
}
