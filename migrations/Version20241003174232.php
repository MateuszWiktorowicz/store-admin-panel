<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241003174232 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADE415FB15');
        $this->addSql('DROP INDEX IDX_D34A04ADE415FB15 ON product');
        $this->addSql('ALTER TABLE product DROP order_item_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD order_item_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADE415FB15 FOREIGN KEY (order_item_id) REFERENCES order_item (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADE415FB15 ON product (order_item_id)');
    }
}
