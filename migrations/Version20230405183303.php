<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405183303 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE infractions_ig (id INT AUTO_INCREMENT NOT NULL, target_uuid_id INT NOT NULL, staff_uuid_id INT NOT NULL, infraction_id INT NOT NULL, infraction_type VARCHAR(30) NOT NULL, reason LONGTEXT DEFAULT NULL, duration DOUBLE PRECISION DEFAULT NULL, end_infraction DATE DEFAULT NULL, infraction_date DATE NOT NULL, infraction_status TINYINT(1) NOT NULL, INDEX IDX_ADD88FA0ADD6CA1 (target_uuid_id), INDEX IDX_ADD88FA09D03C27C (staff_uuid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_ig (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', username VARCHAR(255) NOT NULL, joined_at DATE NOT NULL, is_online TINYINT(1) NOT NULL, is_linked TINYINT(1) NOT NULL, ranks LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_web (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', username VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE infractions_ig ADD CONSTRAINT FK_ADD88FA0ADD6CA1 FOREIGN KEY (target_uuid_id) REFERENCES users_ig (id)');
        $this->addSql('ALTER TABLE infractions_ig ADD CONSTRAINT FK_ADD88FA09D03C27C FOREIGN KEY (staff_uuid_id) REFERENCES users_ig (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE infractions_ig DROP FOREIGN KEY FK_ADD88FA0ADD6CA1');
        $this->addSql('ALTER TABLE infractions_ig DROP FOREIGN KEY FK_ADD88FA09D03C27C');
        $this->addSql('DROP TABLE infractions_ig');
        $this->addSql('DROP TABLE users_ig');
        $this->addSql('DROP TABLE users_web');
    }
}
