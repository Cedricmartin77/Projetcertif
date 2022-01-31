<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220131153446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiche_personnage (id INT AUTO_INCREMENT NOT NULL, encyclopediedupersonnage_id INT NOT NULL, img VARCHAR(255) NOT NULL, aptitudeleader LONGTEXT NOT NULL, nomattaquespecial VARCHAR(255) NOT NULL, descriptionattaquespecial LONGTEXT NOT NULL, nomunisuperattaque VARCHAR(255) NOT NULL, descriptionunitsuperattaque LONGTEXT NOT NULL, nompassiveskill VARCHAR(255) NOT NULL, descriptionpassiveskill LONGTEXT NOT NULL, nomactiveskill VARCHAR(255) NOT NULL, descriptionactiveskill LONGTEXT NOT NULL, listedesliensdupersonnage LONGTEXT NOT NULL, listedescategoriesdupersonnage LONGTEXT NOT NULL, hpdebase INT NOT NULL, attaquedebase INT NOT NULL, defensedebase INT NOT NULL, attaquemax INT NOT NULL, hpmax INT NOT NULL, defensemax INT NOT NULL, INDEX IDX_C4BC4C9AC9404EDE (encyclopediedupersonnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche_personnage ADD CONSTRAINT FK_C4BC4C9AC9404EDE FOREIGN KEY (encyclopediedupersonnage_id) REFERENCES encyclopedie_du_personnage (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE fiche_personnage');
    }
}
