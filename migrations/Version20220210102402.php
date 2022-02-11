<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220210102402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE front_page_nouveau_perso ADD fichepersonnage_id INT NOT NULL');
        $this->addSql('ALTER TABLE front_page_nouveau_perso ADD CONSTRAINT FK_83531BB358FA2CDE FOREIGN KEY (fichepersonnage_id) REFERENCES fiche_personnage (id)');
        $this->addSql('CREATE INDEX IDX_83531BB358FA2CDE ON front_page_nouveau_perso (fichepersonnage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE front_page_nouveau_perso DROP FOREIGN KEY FK_83531BB358FA2CDE');
        $this->addSql('DROP INDEX IDX_83531BB358FA2CDE ON front_page_nouveau_perso');
        $this->addSql('ALTER TABLE front_page_nouveau_perso DROP fichepersonnage_id');
    }
}
