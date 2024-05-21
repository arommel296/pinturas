<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240509192040 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE factura_servicio (factura_id INT NOT NULL, servicio_id INT NOT NULL, INDEX IDX_D0925CA1F04F795F (factura_id), INDEX IDX_D0925CA171CAA3E7 (servicio_id), PRIMARY KEY(factura_id, servicio_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presupuesto_servicio (presupuesto_id INT NOT NULL, servicio_id INT NOT NULL, INDEX IDX_188DD59890119F0F (presupuesto_id), INDEX IDX_188DD59871CAA3E7 (servicio_id), PRIMARY KEY(presupuesto_id, servicio_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE factura_servicio ADD CONSTRAINT FK_D0925CA1F04F795F FOREIGN KEY (factura_id) REFERENCES factura (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factura_servicio ADD CONSTRAINT FK_D0925CA171CAA3E7 FOREIGN KEY (servicio_id) REFERENCES servicio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presupuesto_servicio ADD CONSTRAINT FK_188DD59890119F0F FOREIGN KEY (presupuesto_id) REFERENCES presupuesto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE presupuesto_servicio ADD CONSTRAINT FK_188DD59871CAA3E7 FOREIGN KEY (servicio_id) REFERENCES servicio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE factura ADD usuario_id INT DEFAULT NULL, ADD presupuesto_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE factura ADD CONSTRAINT FK_F9EBA009DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE factura ADD CONSTRAINT FK_F9EBA00990119F0F FOREIGN KEY (presupuesto_id) REFERENCES presupuesto (id)');
        $this->addSql('CREATE INDEX IDX_F9EBA009DB38439E ON factura (usuario_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F9EBA00990119F0F ON factura (presupuesto_id)');
        $this->addSql('ALTER TABLE localidad ADD provincia_id INT NOT NULL');
        $this->addSql('ALTER TABLE localidad ADD CONSTRAINT FK_4F68E0104E7121AF FOREIGN KEY (provincia_id) REFERENCES provincia (id)');
        $this->addSql('CREATE INDEX IDX_4F68E0104E7121AF ON localidad (provincia_id)');
        $this->addSql('ALTER TABLE presupuesto ADD usuario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE presupuesto ADD CONSTRAINT FK_1B6368D3DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_1B6368D3DB38439E ON presupuesto (usuario_id)');
        $this->addSql('ALTER TABLE usuario ADD localidad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D67707C89 FOREIGN KEY (localidad_id) REFERENCES localidad (id)');
        $this->addSql('CREATE INDEX IDX_2265B05D67707C89 ON usuario (localidad_id)');
        $this->addSql('ALTER TABLE valoracion ADD usuario_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE valoracion ADD CONSTRAINT FK_6D3DE0F4DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id)');
        $this->addSql('CREATE INDEX IDX_6D3DE0F4DB38439E ON valoracion (usuario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE factura_servicio DROP FOREIGN KEY FK_D0925CA1F04F795F');
        $this->addSql('ALTER TABLE factura_servicio DROP FOREIGN KEY FK_D0925CA171CAA3E7');
        $this->addSql('ALTER TABLE presupuesto_servicio DROP FOREIGN KEY FK_188DD59890119F0F');
        $this->addSql('ALTER TABLE presupuesto_servicio DROP FOREIGN KEY FK_188DD59871CAA3E7');
        $this->addSql('DROP TABLE factura_servicio');
        $this->addSql('DROP TABLE presupuesto_servicio');
        $this->addSql('ALTER TABLE factura DROP FOREIGN KEY FK_F9EBA009DB38439E');
        $this->addSql('ALTER TABLE factura DROP FOREIGN KEY FK_F9EBA00990119F0F');
        $this->addSql('DROP INDEX IDX_F9EBA009DB38439E ON factura');
        $this->addSql('DROP INDEX UNIQ_F9EBA00990119F0F ON factura');
        $this->addSql('ALTER TABLE factura DROP usuario_id, DROP presupuesto_id');
        $this->addSql('ALTER TABLE localidad DROP FOREIGN KEY FK_4F68E0104E7121AF');
        $this->addSql('DROP INDEX IDX_4F68E0104E7121AF ON localidad');
        $this->addSql('ALTER TABLE localidad DROP provincia_id');
        $this->addSql('ALTER TABLE presupuesto DROP FOREIGN KEY FK_1B6368D3DB38439E');
        $this->addSql('DROP INDEX IDX_1B6368D3DB38439E ON presupuesto');
        $this->addSql('ALTER TABLE presupuesto DROP usuario_id');
        $this->addSql('ALTER TABLE usuario DROP FOREIGN KEY FK_2265B05D67707C89');
        $this->addSql('DROP INDEX IDX_2265B05D67707C89 ON usuario');
        $this->addSql('ALTER TABLE usuario DROP localidad_id');
        $this->addSql('ALTER TABLE valoracion DROP FOREIGN KEY FK_6D3DE0F4DB38439E');
        $this->addSql('DROP INDEX IDX_6D3DE0F4DB38439E ON valoracion');
        $this->addSql('ALTER TABLE valoracion DROP usuario_id');
    }
}
