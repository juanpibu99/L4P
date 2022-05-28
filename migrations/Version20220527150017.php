<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220527150017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE juega (id INT AUTO_INCREMENT NOT NULL, username_user_id INT DEFAULT NULL, id_juego_id INT DEFAULT NULL, INDEX IDX_17546D3A58A3ED40 (username_user_id), INDEX IDX_17546D3A43ECBEC0 (id_juego_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE juega ADD CONSTRAINT FK_17546D3A58A3ED40 FOREIGN KEY (username_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE juega ADD CONSTRAINT FK_17546D3A43ECBEC0 FOREIGN KEY (id_juego_id) REFERENCES juego (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE juega');
    }
}
