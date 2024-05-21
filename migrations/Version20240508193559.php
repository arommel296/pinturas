<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240508193559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE factura ADD contenido LONGTEXT NOT NULL, ADD enviado TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE presupuesto ADD contenido LONGTEXT NOT NULL, ADD enviado TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE servicio ADD icono LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE trabajo ADD descripcion LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD nombre VARCHAR(100) NOT NULL, ADD apellidos VARCHAR(100) NOT NULL, ADD telefono VARCHAR(9) DEFAULT NULL, ADD foto LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE valoracion ADD titulo VARCHAR(100) NOT NULL, ADD fotos JSON DEFAULT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE factura DROP contenido, DROP enviado');
        $this->addSql('ALTER TABLE presupuesto DROP contenido, DROP enviado');
        $this->addSql('ALTER TABLE servicio DROP icono');
        $this->addSql('ALTER TABLE trabajo DROP descripcion');
        $this->addSql('ALTER TABLE usuario DROP nombre, DROP apellidos, DROP telefono, DROP foto');
        $this->addSql('ALTER TABLE valoracion DROP titulo, DROP fotos');
    }
}
