<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220115194554 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiche_personnage_rarete_ssr (id INT AUTO_INCREMENT NOT NULL, img VARCHAR(255) NOT NULL, descriptionaptitudeleader LONGTEXT NOT NULL, nomsuperattaque VARCHAR(255) NOT NULL, descriptionsuperattaque LONGTEXT NOT NULL, nompassiveskill VARCHAR(255) NOT NULL, descriptionpassiveskill LONGTEXT NOT NULL, listedesliensdupersonnage LONGTEXT NOT NULL, listedescategoriesdupersonnage LONGTEXT NOT NULL, hpdebase INT NOT NULL, attaquedebase INT NOT NULL, defensedebase INT NOT NULL, hpmax INT NOT NULL, attaquemax INT NOT NULL, defensemax INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage ADD fiche_personnage_rarete_ssr_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage ADD CONSTRAINT FK_8BA12D7FA38595CD FOREIGN KEY (fiche_personnage_rarete_ssr_id) REFERENCES fiche_personnage_rarete_ssr (id)');
        $this->addSql('CREATE INDEX IDX_8BA12D7FA38595CD ON encyclopedie_du_personnage (fiche_personnage_rarete_ssr_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encyclopedie_du_personnage DROP FOREIGN KEY FK_8BA12D7FA38595CD');
        $this->addSql('DROP TABLE fiche_personnage_rarete_ssr');
        $this->addSql('DROP INDEX IDX_8BA12D7FA38595CD ON encyclopedie_du_personnage');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage DROP fiche_personnage_rarete_ssr_id');
    }
}
