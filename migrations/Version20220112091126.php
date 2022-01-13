<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220112091126 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encyclopedie_du_personnage ADD encycloepdiedespersonnages_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage ADD CONSTRAINT FK_8BA12D7F12D84E57 FOREIGN KEY (encycloepdiedespersonnages_id) REFERENCES encyclopedie_des_personnages (id)');
        $this->addSql('CREATE INDEX IDX_8BA12D7F12D84E57 ON encyclopedie_du_personnage (encycloepdiedespersonnages_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encyclopedie_du_personnage DROP FOREIGN KEY FK_8BA12D7F12D84E57');
        $this->addSql('DROP INDEX IDX_8BA12D7F12D84E57 ON encyclopedie_du_personnage');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage DROP encycloepdiedespersonnages_id');
    }
}
