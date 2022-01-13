<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220112133246 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encyclopedie_du_personnage ADD encyclopediedespersonnages_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage ADD CONSTRAINT FK_8BA12D7F3661661F FOREIGN KEY (encyclopediedespersonnages_id) REFERENCES encyclopedie_des_personnages (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8BA12D7F3661661F ON encyclopedie_du_personnage (encyclopediedespersonnages_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encyclopedie_du_personnage DROP FOREIGN KEY FK_8BA12D7F3661661F');
        $this->addSql('DROP INDEX UNIQ_8BA12D7F3661661F ON encyclopedie_du_personnage');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage DROP encyclopediedespersonnages_id');
    }
}
