<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113122327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33127D5C145');
        $this->addSql('ALTER TABLE book DROP FOREIGN KEY FK_CBE5A331AA60395A');
        $this->addSql('DROP INDEX IDX_CBE5A331AA60395A ON book');
        $this->addSql('DROP INDEX IDX_CBE5A33127D5C145 ON book');
        $this->addSql('ALTER TABLE book DROP ordered_id, DROP ordered_item_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE book ADD ordered_id INT DEFAULT NULL, ADD ordered_item_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A33127D5C145 FOREIGN KEY (ordered_item_id) REFERENCES order_item (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE book ADD CONSTRAINT FK_CBE5A331AA60395A FOREIGN KEY (ordered_id) REFERENCES `order` (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_CBE5A331AA60395A ON book (ordered_id)');
        $this->addSql('CREATE INDEX IDX_CBE5A33127D5C145 ON book (ordered_item_id)');
    }
}
