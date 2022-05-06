<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506134833 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sub_category (id INT AUTO_INCREMENT NOT NULL, id_category_id INT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modified_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_BCE3F798A545015 (id_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sub_category ADD CONSTRAINT FK_BCE3F798A545015 FOREIGN KEY (id_category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EDA6C9BFF');
        $this->addSql('DROP INDEX idx_29d6873eda6c9bff ON offer');
        $this->addSql('CREATE INDEX IDX_29D6873EACBCAC3B ON offer (offers_type_id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EDA6C9BFF FOREIGN KEY (offers_type_id) REFERENCES offers_type (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sub_category');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873EACBCAC3B');
        $this->addSql('DROP INDEX idx_29d6873eacbcac3b ON offer');
        $this->addSql('CREATE INDEX IDX_29D6873EDA6C9BFF ON offer (offers_type_id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873EACBCAC3B FOREIGN KEY (offers_type_id) REFERENCES offers_type (id)');
    }
}
