<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230119142044 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fin_bilan (id INT AUTO_INCREMENT NOT NULL, play_id INT DEFAULT NULL, year VARCHAR(4) DEFAULT NULL, active TINYINT(1) NOT NULL, INDEX IDX_127862D325576DBD (play_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fin_bilan ADD CONSTRAINT FK_127862D325576DBD FOREIGN KEY (play_id) REFERENCES play (id)');
        $this->addSql('ALTER TABLE fin_expense ADD fin_bilan_id INT DEFAULT NULL, DROP year');
        $this->addSql('ALTER TABLE fin_expense ADD CONSTRAINT FK_56E52BA9E09BBE60 FOREIGN KEY (fin_bilan_id) REFERENCES fin_bilan (id)');
        $this->addSql('CREATE INDEX IDX_56E52BA9E09BBE60 ON fin_expense (fin_bilan_id)');
        $this->addSql('ALTER TABLE fin_income ADD fin_bilan_id INT DEFAULT NULL, DROP year');
        $this->addSql('ALTER TABLE fin_income ADD CONSTRAINT FK_5125C31AE09BBE60 FOREIGN KEY (fin_bilan_id) REFERENCES fin_bilan (id)');
        $this->addSql('CREATE INDEX IDX_5125C31AE09BBE60 ON fin_income (fin_bilan_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fin_expense DROP FOREIGN KEY FK_56E52BA9E09BBE60');
        $this->addSql('ALTER TABLE fin_income DROP FOREIGN KEY FK_5125C31AE09BBE60');
        $this->addSql('ALTER TABLE fin_bilan DROP FOREIGN KEY FK_127862D325576DBD');
        $this->addSql('DROP TABLE fin_bilan');
        $this->addSql('DROP INDEX IDX_56E52BA9E09BBE60 ON fin_expense');
        $this->addSql('ALTER TABLE fin_expense ADD year VARCHAR(4) DEFAULT NULL, DROP fin_bilan_id');
        $this->addSql('DROP INDEX IDX_5125C31AE09BBE60 ON fin_income');
        $this->addSql('ALTER TABLE fin_income ADD year VARCHAR(4) DEFAULT NULL, DROP fin_bilan_id');
    }
}
