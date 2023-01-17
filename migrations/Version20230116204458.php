<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230116204458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE play_gallery (id INT AUTO_INCREMENT NOT NULL, play_id INT NOT NULL, image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', position SMALLINT DEFAULT NULL, INDEX IDX_72CC86FCD0R12O09 (play_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE play_gallery ADD CONSTRAINT FK_72CC86FCD0R12O09 FOREIGN KEY (play_id) REFERENCES play (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE play_gallery DROP FOREIGN KEY FK_72CC86FCD0R12O09');
        $this->addSql('DROP TABLE play_gallery');
        
    }
}
