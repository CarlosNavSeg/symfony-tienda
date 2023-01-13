<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113114642 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331AA60395A FOREIGN KEY (ordered_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33127D5C145 FOREIGN KEY (ordered_item_id) REFERENCES order_item (id)');
        $this->addSql('ALTER TABLE `order` ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331AA60395A');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33127D5C145');
    }
}
