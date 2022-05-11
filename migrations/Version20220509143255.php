<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220509143255 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE offers_skills_assoc (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modified_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE offer ADD skills_to_offer_assoc_id INT NOT NULL, CHANGE id_sub_category_id id_sub_category_id INT DEFAULT NULL, CHANGE recruiter_id recruiter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E80CA00DD FOREIGN KEY (skills_to_offer_assoc_id) REFERENCES offers_skills_assoc (id)');
        $this->addSql('CREATE INDEX IDX_29D6873E80CA00DD ON offer (skills_to_offer_assoc_id)');
        $this->addSql('ALTER TABLE skill ADD assoc_offers_skills_id INT NOT NULL');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477A95E70B8 FOREIGN KEY (assoc_offers_skills_id) REFERENCES offers_skills_assoc (id)');
        $this->addSql('CREATE INDEX IDX_5E3DE477A95E70B8 ON skill (assoc_offers_skills_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E80CA00DD');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477A95E70B8');
        $this->addSql('DROP TABLE offers_skills_assoc');
        $this->addSql('DROP INDEX IDX_29D6873E80CA00DD ON offer');
        $this->addSql('ALTER TABLE offer DROP skills_to_offer_assoc_id, CHANGE id_sub_category_id id_sub_category_id INT NOT NULL, CHANGE recruiter_id recruiter_id INT NOT NULL');
        $this->addSql('DROP INDEX IDX_5E3DE477A95E70B8 ON skill');
        $this->addSql('ALTER TABLE skill DROP assoc_offers_skills_id');
    }
}
