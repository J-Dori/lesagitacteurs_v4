<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230117124816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actor (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(25) NOT NULL, lastname VARCHAR(50) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, resp_firstname VARCHAR(25) DEFAULT NULL, resp_lastname VARCHAR(50) DEFAULT NULL, resp_phone VARCHAR(15) DEFAULT NULL, resp_email VARCHAR(255) DEFAULT NULL, state VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(50) DEFAULT NULL, lastname VARCHAR(50) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(5) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, mobile_phone VARCHAR(25) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact_social (id INT AUTO_INCREMENT NOT NULL, address VARCHAR(255) DEFAULT NULL, zip_code VARCHAR(5) DEFAULT NULL, city VARCHAR(100) DEFAULT NULL, map_link VARCHAR(1000) DEFAULT NULL, facebook VARCHAR(255) DEFAULT NULL, youtube VARCHAR(255) DEFAULT NULL, instagram VARCHAR(255) DEFAULT NULL, mobile_phone VARCHAR(25) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, enabled TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE easy_admin__reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_DB1E0C65A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE easy_admin__user (id INT AUTO_INCREMENT NOT NULL, enabled TINYINT(1) NOT NULL, firstname VARCHAR(255) DEFAULT NULL, lastname VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_AAFD4C04E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE easy_media__folder (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(100) NOT NULL, INDEX IDX_1C446171727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE easy_media__media (id INT AUTO_INCREMENT NOT NULL, folder_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(100) NOT NULL, mime VARCHAR(255) DEFAULT NULL, size INT DEFAULT NULL, last_modified INT DEFAULT NULL, metas JSON NOT NULL, INDEX IDX_83D7599C162CB942 (folder_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fin_category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fin_expense (id INT AUTO_INCREMENT NOT NULL, play_id INT DEFAULT NULL, category_id INT DEFAULT NULL, date DATE DEFAULT NULL, pay_mode VARCHAR(25) DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, doc_number VARCHAR(255) DEFAULT NULL, notes VARCHAR(5000) DEFAULT NULL, INDEX IDX_56E52BA925576DBD (play_id), INDEX IDX_56E52BA912469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fin_income (id INT AUTO_INCREMENT NOT NULL, play_id INT DEFAULT NULL, category_id INT DEFAULT NULL, date DATE DEFAULT NULL, pay_mode VARCHAR(25) DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, doc_number VARCHAR(255) DEFAULT NULL, notes VARCHAR(5000) DEFAULT NULL, INDEX IDX_5125C31A25576DBD (play_id), INDEX IDX_5125C31A12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page (id INT UNSIGNED AUTO_INCREMENT NOT NULL, parent_id INT UNSIGNED DEFAULT NULL, name VARCHAR(100) NOT NULL, slug VARCHAR(100) NOT NULL, state VARCHAR(100) NOT NULL, action VARCHAR(255) DEFAULT NULL, template VARCHAR(255) DEFAULT NULL, css LONGTEXT DEFAULT NULL, js LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, publish_date DATETIME DEFAULT NULL, unpublish_date DATETIME DEFAULT NULL, seo_title VARCHAR(255) NOT NULL, seo_description LONGTEXT DEFAULT NULL, seo_keywords VARCHAR(255) DEFAULT NULL, seo_cannonical VARCHAR(255) DEFAULT NULL, seo_cover TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', seo_key VARCHAR(255) DEFAULT NULL, seo_sitemap TINYINT(1) NOT NULL, seo_robots JSON NOT NULL, UNIQUE INDEX UNIQ_140AB620989D9B62 (slug), INDEX IDX_140AB620727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE play (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(5000) DEFAULT NULL, year VARCHAR(4) NOT NULL, date_start DATE DEFAULT NULL, date_end DATE DEFAULT NULL, play_status VARCHAR(15) DEFAULT NULL, state VARCHAR(15) NOT NULL, image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE play_actor_role (id INT AUTO_INCREMENT NOT NULL, play_id INT NOT NULL, actor_id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, state VARCHAR(15) NOT NULL, INDEX IDX_72CC86FC25576DBD (play_id), INDEX IDX_72CC86FC10DAF24A (actor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE play_gallery (id INT AUTO_INCREMENT NOT NULL, play_id INT DEFAULT NULL, image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', position SMALLINT DEFAULT NULL, INDEX IDX_31351F8A25576DBD (play_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(25) NOT NULL, lastname VARCHAR(25) DEFAULT NULL, role VARCHAR(100) NOT NULL, role_order SMALLINT NOT NULL, description VARCHAR(255) NOT NULL, image TEXT DEFAULT NULL COMMENT \'(DC2Type:easy_media_type)\', email VARCHAR(255) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, state VARCHAR(15) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE easy_admin__reset_password_request ADD CONSTRAINT FK_DB1E0C65A76ED395 FOREIGN KEY (user_id) REFERENCES easy_admin__user (id)');
        $this->addSql('ALTER TABLE easy_media__folder ADD CONSTRAINT FK_1C446171727ACA70 FOREIGN KEY (parent_id) REFERENCES easy_media__folder (id) ON DELETE SET NULL');
        $this->addSql('ALTER TABLE easy_media__media ADD CONSTRAINT FK_83D7599C162CB942 FOREIGN KEY (folder_id) REFERENCES easy_media__folder (id)');
        $this->addSql('ALTER TABLE fin_expense ADD CONSTRAINT FK_56E52BA925576DBD FOREIGN KEY (play_id) REFERENCES play (id)');
        $this->addSql('ALTER TABLE fin_expense ADD CONSTRAINT FK_56E52BA912469DE2 FOREIGN KEY (category_id) REFERENCES fin_category (id)');
        $this->addSql('ALTER TABLE fin_income ADD CONSTRAINT FK_5125C31A25576DBD FOREIGN KEY (play_id) REFERENCES play (id)');
        $this->addSql('ALTER TABLE fin_income ADD CONSTRAINT FK_5125C31A12469DE2 FOREIGN KEY (category_id) REFERENCES fin_category (id)');
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB620727ACA70 FOREIGN KEY (parent_id) REFERENCES page (id)');
        $this->addSql('ALTER TABLE play_actor_role ADD CONSTRAINT FK_72CC86FC25576DBD FOREIGN KEY (play_id) REFERENCES play (id)');
        $this->addSql('ALTER TABLE play_actor_role ADD CONSTRAINT FK_72CC86FC10DAF24A FOREIGN KEY (actor_id) REFERENCES actor (id)');
        $this->addSql('ALTER TABLE play_gallery ADD CONSTRAINT FK_31351F8A25576DBD FOREIGN KEY (play_id) REFERENCES play (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE easy_admin__reset_password_request DROP FOREIGN KEY FK_DB1E0C65A76ED395');
        $this->addSql('ALTER TABLE easy_media__folder DROP FOREIGN KEY FK_1C446171727ACA70');
        $this->addSql('ALTER TABLE easy_media__media DROP FOREIGN KEY FK_83D7599C162CB942');
        $this->addSql('ALTER TABLE fin_expense DROP FOREIGN KEY FK_56E52BA925576DBD');
        $this->addSql('ALTER TABLE fin_expense DROP FOREIGN KEY FK_56E52BA912469DE2');
        $this->addSql('ALTER TABLE fin_income DROP FOREIGN KEY FK_5125C31A25576DBD');
        $this->addSql('ALTER TABLE fin_income DROP FOREIGN KEY FK_5125C31A12469DE2');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB620727ACA70');
        $this->addSql('ALTER TABLE play_actor_role DROP FOREIGN KEY FK_72CC86FC25576DBD');
        $this->addSql('ALTER TABLE play_actor_role DROP FOREIGN KEY FK_72CC86FC10DAF24A');
        $this->addSql('ALTER TABLE play_gallery DROP FOREIGN KEY FK_31351F8A25576DBD');
        $this->addSql('DROP TABLE actor');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE contact_social');
        $this->addSql('DROP TABLE easy_admin__reset_password_request');
        $this->addSql('DROP TABLE easy_admin__user');
        $this->addSql('DROP TABLE easy_media__folder');
        $this->addSql('DROP TABLE easy_media__media');
        $this->addSql('DROP TABLE fin_category');
        $this->addSql('DROP TABLE fin_expense');
        $this->addSql('DROP TABLE fin_income');
        $this->addSql('DROP TABLE page');
        $this->addSql('DROP TABLE play');
        $this->addSql('DROP TABLE play_actor_role');
        $this->addSql('DROP TABLE play_gallery');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
