<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230415134639 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE infractions (id INT AUTO_INCREMENT NOT NULL, target_uuid_id INT NOT NULL, staff_uuid_id INT DEFAULT NULL, type VARCHAR(25) NOT NULL, reason LONGTEXT DEFAULT NULL, duration DOUBLE PRECISION DEFAULT NULL, date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', end_date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', status TINYINT(1) NOT NULL, INDEX IDX_D6186DC0ADD6CA1 (target_uuid_id), INDEX IDX_D6186DC09D03C27C (staff_uuid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_ig (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', username VARCHAR(50) NOT NULL, first_join_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_join_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_online TINYINT(1) NOT NULL, ranks LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', is_op TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE infractions ADD CONSTRAINT FK_D6186DC0ADD6CA1 FOREIGN KEY (target_uuid_id) REFERENCES user_ig (id)');
        $this->addSql('ALTER TABLE infractions ADD CONSTRAINT FK_D6186DC09D03C27C FOREIGN KEY (staff_uuid_id) REFERENCES user_ig (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE infractions DROP FOREIGN KEY FK_D6186DC0ADD6CA1');
        $this->addSql('ALTER TABLE infractions DROP FOREIGN KEY FK_D6186DC09D03C27C');
        $this->addSql('DROP TABLE infractions');
        $this->addSql('DROP TABLE user_ig');
    }
}
