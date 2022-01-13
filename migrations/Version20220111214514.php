<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220111214514 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE encyclopedie_des_personnages (id INT AUTO_INCREMENT NOT NULL, encyclopediedupersonnage_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, img VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7C804075C9404EDE (encyclopediedupersonnage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE encyclopedie_du_personnage (id INT AUTO_INCREMENT NOT NULL, encyclopediedespersonnages_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, img VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8BA12D7F3661661F (encyclopediedespersonnages_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE encyclopedie_des_personnages ADD CONSTRAINT FK_7C804075C9404EDE FOREIGN KEY (encyclopediedupersonnage_id) REFERENCES encyclopedie_du_personnage (id)');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage ADD CONSTRAINT FK_8BA12D7F3661661F FOREIGN KEY (encyclopediedespersonnages_id) REFERENCES encyclopedie_des_personnages (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encyclopedie_du_personnage DROP FOREIGN KEY FK_8BA12D7F3661661F');
        $this->addSql('ALTER TABLE encyclopedie_des_personnages DROP FOREIGN KEY FK_7C804075C9404EDE');
        $this->addSql('DROP TABLE encyclopedie_des_personnages');
        $this->addSql('DROP TABLE encyclopedie_du_personnage');
        $this->addSql('DROP TABLE user');
    }
}
