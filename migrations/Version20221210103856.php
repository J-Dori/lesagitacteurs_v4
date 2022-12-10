<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221210103856 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(25) NOT NULL, lastname VARCHAR(50) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, resp_firstname VARCHAR(25) DEFAULT NULL, resp_lastname VARCHAR(50) DEFAULT NULL, resp_phone VARCHAR(15) DEFAULT NULL, resp_email VARCHAR(255) DEFAULT NULL, state VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE play (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(5000) DEFAULT NULL, year VARCHAR(4) NOT NULL, date_start DATE DEFAULT NULL, date_end DATE DEFAULT NULL, play_status VARCHAR(15) DEFAULT NULL, state VARCHAR(15) NOT NULL, image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE play_actor_role (id INT AUTO_INCREMENT NOT NULL, play_id INT NOT NULL, actor_id INT NOT NULL, name VARCHAR(255) NOT NULL, state VARCHAR(15) NOT NULL, INDEX IDX_72CC86FC25576DBD (play_id), INDEX IDX_72CC86FC10DAF24A (actor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(25) NOT NULL, lastname VARCHAR(25) DEFAULT NULL, role VARCHAR(100) NOT NULL, role_order SMALLINT NOT NULL, description VARCHAR(255) NOT NULL, image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', email VARCHAR(255) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, state VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE play_actor_role ADD CONSTRAINT FK_72CC86FC25576DBD FOREIGN KEY (play_id) REFERENCES play (id)');
        $this->addSql('ALTER TABLE play_actor_role ADD CONSTRAINT FK_72CC86FC10DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE play_actor_role DROP FOREIGN KEY FK_72CC86FC25576DBD');
        $this->addSql('ALTER TABLE play_actor_role DROP FOREIGN KEY FK_72CC86FC10DAF24A');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE play');
        $this->addSql('DROP TABLE play_actor_role');
        $this->addSql('DROP TABLE team');
    }
}
