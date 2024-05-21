<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240509194005 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trabajo ADD factura_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trabajo ADD CONSTRAINT FK_FDD6B80AF04F795F FOREIGN KEY (factura_id) REFERENCES factura (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FDD6B80AF04F795F ON trabajo (factura_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trabajo DROP FOREIGN KEY FK_FDD6B80AF04F795F');
        $this->addSql('DROP INDEX UNIQ_FDD6B80AF04F795F ON trabajo');
        $this->addSql('ALTER TABLE trabajo DROP factura_id');
    }
}
