<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230419174923 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE infractions (id INT AUTO_INCREMENT NOT NULL, target_uuid_id INT NOT NULL, staff_uuid_id INT DEFAULT NULL, type VARCHAR(25) NOT NULL, reason LONGTEXT DEFAULT NULL, duration DOUBLE PRECISION DEFAULT NULL, date DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', end_date DATE DEFAULT NULL COMMENT \'(DC2Type:date_immutable)\', status TINYINT(1) NOT NULL, INDEX IDX_D6186DC0ADD6CA1 (target_uuid_id), INDEX IDX_D6186DC09D03C27C (staff_uuid_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shop_item (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, quantity INT DEFAULT NULL, on_shop TINYINT(1) NOT NULL, description LONGTEXT DEFAULT NULL, UNIQUE INDEX UNIQ_DEE9C365AEA349138947610D (reference, designation), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:simple_array)\', password VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, code CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', is_linked TINYINT(1) NOT NULL, is_verified TINYINT(1) NOT NULL, skin_url VARCHAR(255) DEFAULT NULL, created_at DATE NOT NULL COMMENT \'(DC2Type:date_immutable)\', UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), UNIQUE INDEX UNIQ_8D93D64977153098 (code), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_ig (id INT AUTO_INCREMENT NOT NULL, uuid CHAR(36) NOT NULL COMMENT \'(DC2Type:guid)\', username VARCHAR(50) NOT NULL, first_join_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', last_join_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_online TINYINT(1) NOT NULL, is_op TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_ig_shop_item (user_ig_id INT NOT NULL, shop_item_id INT NOT NULL, INDEX IDX_47F265418F33CAE1 (user_ig_id), INDEX IDX_47F26541115C1274 (shop_item_id), PRIMARY KEY(user_ig_id, shop_item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE infractions ADD CONSTRAINT FK_D6186DC0ADD6CA1 FOREIGN KEY (target_uuid_id) REFERENCES user_ig (id)');
        $this->addSql('ALTER TABLE infractions ADD CONSTRAINT FK_D6186DC09D03C27C FOREIGN KEY (staff_uuid_id) REFERENCES user_ig (id)');
        $this->addSql('ALTER TABLE user_ig_shop_item ADD CONSTRAINT FK_47F265418F33CAE1 FOREIGN KEY (user_ig_id) REFERENCES user_ig (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_ig_shop_item ADD CONSTRAINT FK_47F26541115C1274 FOREIGN KEY (shop_item_id) REFERENCES shop_item (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE infractions DROP FOREIGN KEY FK_D6186DC0ADD6CA1');
        $this->addSql('ALTER TABLE infractions DROP FOREIGN KEY FK_D6186DC09D03C27C');
        $this->addSql('ALTER TABLE user_ig_shop_item DROP FOREIGN KEY FK_47F265418F33CAE1');
        $this->addSql('ALTER TABLE user_ig_shop_item DROP FOREIGN KEY FK_47F26541115C1274');
        $this->addSql('DROP TABLE infractions');
        $this->addSql('DROP TABLE shop_item');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_ig');
        $this->addSql('DROP TABLE user_ig_shop_item');
    }
}
