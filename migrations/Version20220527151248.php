<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220527151248 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reporta (id INT AUTO_INCREMENT NOT NULL, id_user_id INT DEFAULT NULL, id_post_id INT DEFAULT NULL, tipo_report INT NOT NULL, INDEX IDX_2A6D60D79F37AE5 (id_user_id), INDEX IDX_2A6D60D9514AA5C (id_post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reporta ADD CONSTRAINT FK_2A6D60D79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reporta ADD CONSTRAINT FK_2A6D60D9514AA5C FOREIGN KEY (id_post_id) REFERENCES post (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reporta');
    }
}
