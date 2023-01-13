<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113114238 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, order_price DOUBLE PRECISION NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_item (id INT AUTO_INCREMENT NOT NULL, order_ref_id INT NOT NULL, order_items_id INT DEFAULT NULL, quantity INT NOT NULL, INDEX IDX_52EA1F09E238517C (order_ref_id), INDEX IDX_52EA1F098A484C35 (order_items_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09E238517C FOREIGN KEY (order_ref_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F098A484C35 FOREIGN KEY (order_items_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE book ADD ordered_id INT DEFAULT NULL, ADD ordered_item_id INT DEFAULT NULL');
        $this->addSql('CREATE INDEX IDX_CBE5A331AA60395A ON book (ordered_id)');
        $this->addSql('CREATE INDEX IDX_CBE5A33127D5C145 ON book (ordered_item_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE order_item');
        $this->addSql('DROP INDEX IDX_CBE5A331AA60395A ON book');
        $this->addSql('DROP INDEX IDX_CBE5A33127D5C145 ON book');
        $this->addSql('ALTER TABLE book DROP ordered_id, DROP ordered_item_id');
    }
}
