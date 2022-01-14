<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220114105042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encyclopedie_du_personnage ADD fichepersonnageraretessr_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage ADD CONSTRAINT FK_8BA12D7F2EB9756B FOREIGN KEY (fichepersonnageraretessr_id) REFERENCES fiche_personnage_rarete_ssr (id)');
        $this->addSql('CREATE INDEX IDX_8BA12D7F2EB9756B ON encyclopedie_du_personnage (fichepersonnageraretessr_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encyclopedie_du_personnage DROP FOREIGN KEY FK_8BA12D7F2EB9756B');
        $this->addSql('DROP INDEX IDX_8BA12D7F2EB9756B ON encyclopedie_du_personnage');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage DROP fichepersonnageraretessr_id');
    }
}
