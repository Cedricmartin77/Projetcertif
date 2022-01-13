<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220112135405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encyclopedie_du_personnage ADD encyclopedie_des_personnages_id INT DEFAULT NULL, ADD encyclopediedespersonnages_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage ADD CONSTRAINT FK_8BA12D7F29BAA3D2 FOREIGN KEY (encyclopedie_des_personnages_id) REFERENCES encyclopedie_des_personnages (id)');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage ADD CONSTRAINT FK_8BA12D7F3661661F FOREIGN KEY (encyclopediedespersonnages_id) REFERENCES encyclopedie_des_personnages (id)');
        $this->addSql('CREATE INDEX IDX_8BA12D7F29BAA3D2 ON encyclopedie_du_personnage (encyclopedie_des_personnages_id)');
        $this->addSql('CREATE INDEX IDX_8BA12D7F3661661F ON encyclopedie_du_personnage (encyclopediedespersonnages_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE encyclopedie_du_personnage DROP FOREIGN KEY FK_8BA12D7F29BAA3D2');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage DROP FOREIGN KEY FK_8BA12D7F3661661F');
        $this->addSql('DROP INDEX IDX_8BA12D7F29BAA3D2 ON encyclopedie_du_personnage');
        $this->addSql('DROP INDEX IDX_8BA12D7F3661661F ON encyclopedie_du_personnage');
        $this->addSql('ALTER TABLE encyclopedie_du_personnage DROP encyclopedie_des_personnages_id, DROP encyclopediedespersonnages_id');
    }
}
