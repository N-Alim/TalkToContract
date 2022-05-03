<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220503123835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offer (id INT AUTO_INCREMENT NOT NULL, offers_type_id INT NOT NULL, department_id INT NOT NULL, job_name VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, tasks LONGTEXT NOT NULL, week_hours_number INT NOT NULL, town VARCHAR(255) NOT NULL, address LONGTEXT DEFAULT NULL, company VARCHAR(255) NOT NULL, experience INT NOT NULL, active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modified_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_29D6873EDA6C9BFF (offers_type_id), INDEX IDX_29D6873EAE80F5DF (department_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EDA6C9BFF FOREIGN KEY (offers_type_id) REFERENCES offers_type (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EAE80F5DF FOREIGN KEY (department_id) REFERENCES department (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE offer');
    }
}
