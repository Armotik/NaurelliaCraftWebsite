<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230405183900 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE infractions_ig ADD CONSTRAINT FK_ADD88FA0ADD6CA1 FOREIGN KEY (target_uuid_id) REFERENCES users_ig (id)');
        $this->addSql('ALTER TABLE infractions_ig ADD CONSTRAINT FK_ADD88FA09D03C27C FOREIGN KEY (staff_uuid_id) REFERENCES users_ig (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE infractions_ig DROP FOREIGN KEY FK_ADD88FA0ADD6CA1');
        $this->addSql('ALTER TABLE infractions_ig DROP FOREIGN KEY FK_ADD88FA09D03C27C');
    }
}
