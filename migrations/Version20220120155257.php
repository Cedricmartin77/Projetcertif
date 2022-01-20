<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220120155257 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiche_personnage_ur (id INT AUTO_INCREMENT NOT NULL, encyclopediedupersonnage_id INT NOT NULL, img VARCHAR(255) NOT NULL, aptitudeleader VARCHAR(255) NOT NULL, nomattaquespecial VARCHAR(255) NOT NULL, descriptionattaquespecial LONGTEXT NOT NULL, nomaptitudepassive VARCHAR(255) NOT NULL, descriptionaptitudepassive LONGTEXT NOT NULL, listedeliensdupersonnage LONGTEXT NOT NULL, listedescategoriesdupersonnage LONGTEXT NOT NULL, hpdebase INT NOT NULL, attaquedebase INT NOT NULL, defensedebase INT NOT NULL, hpmax INT NOT NULL, attaquemax INT NOT NULL, defensemax INT NOT NULL, INDEX IDX_1A7DEF70C9404EDE (encyclopediedupersonnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche_personnage_ur ADD CONSTRAINT FK_1A7DEF70C9404EDE FOREIGN KEY (encyclopediedupersonnage_id) REFERENCES encyclopedie_du_personnage (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE fiche_personnage_ur');
    }
}
