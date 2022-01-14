<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220114104823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_personnage_rarete_ssr DROP FOREIGN KEY FK_5FBDDD6BC9404EDE');
        $this->addSql('DROP INDEX IDX_5FBDDD6BC9404EDE ON fiche_personnage_rarete_ssr');
        $this->addSql('ALTER TABLE fiche_personnage_rarete_ssr DROP encyclopediedupersonnage_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_personnage_rarete_ssr ADD encyclopediedupersonnage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_personnage_rarete_ssr ADD CONSTRAINT FK_5FBDDD6BC9404EDE FOREIGN KEY (encyclopediedupersonnage_id) REFERENCES encyclopedie_du_personnage (id)');
        $this->addSql('CREATE INDEX IDX_5FBDDD6BC9404EDE ON fiche_personnage_rarete_ssr (encyclopediedupersonnage_id)');
    }
}
