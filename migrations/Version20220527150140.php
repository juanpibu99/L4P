<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220527150140 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post ADD id_juego_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D43ECBEC0 FOREIGN KEY (id_juego_id) REFERENCES juego (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D43ECBEC0 ON post (id_juego_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D43ECBEC0');
        $this->addSql('DROP INDEX IDX_5A8A6C8D43ECBEC0 ON post');
        $this->addSql('ALTER TABLE post DROP id_juego_id');
    }
}
