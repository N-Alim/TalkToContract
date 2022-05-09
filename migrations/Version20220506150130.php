<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220506150130 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer ADD id_sub_category_id INT DEFAULT NULL, ADD recruiter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E1EE12BF4 FOREIGN KEY (id_sub_category_id) REFERENCES sub_category (id)');
        $this->addSql('ALTER TABLE offer ADD CONSTRAINT FK_29D6873E156BE243 FOREIGN KEY (recruiter_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_29D6873E1EE12BF4 ON offer (id_sub_category_id)');
        $this->addSql('CREATE INDEX IDX_29D6873E156BE243 ON offer (recruiter_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E1EE12BF4');
        $this->addSql('ALTER TABLE offer DROP FOREIGN KEY FK_29D6873E156BE243');
        $this->addSql('DROP INDEX IDX_29D6873E1EE12BF4 ON offer');
        $this->addSql('DROP INDEX IDX_29D6873E156BE243 ON offer');
        $this->addSql('ALTER TABLE offer DROP id_sub_category_id, DROP recruiter_id');
    }
}
