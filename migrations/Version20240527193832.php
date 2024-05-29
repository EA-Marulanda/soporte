<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240527193832 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agente_externo (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, correo VARCHAR(255) NOT NULL, cedula VARCHAR(50) NOT NULL, UNIQUE INDEX UNIQ_2BB946D57BF39BE0 (cedula), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soporte (id INT AUTO_INCREMENT NOT NULL, id_agente_externo INT DEFAULT NULL, asunto VARCHAR(255) NOT NULL, descripcion LONGTEXT NOT NULL, fecha DATETIME NOT NULL, INDEX IDX_2273AC616DFFBD3 (id_agente_externo), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario_soporte (id INT AUTO_INCREMENT NOT NULL, id_usuario INT DEFAULT NULL, id_soporte INT DEFAULT NULL, INDEX IDX_7B019081FCF8192D (id_usuario), INDEX IDX_7B019081DCBA93B6 (id_soporte), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE soporte ADD CONSTRAINT FK_2273AC616DFFBD3 FOREIGN KEY (id_agente_externo) REFERENCES agente_externo (id)');
        $this->addSql('ALTER TABLE usuario_soporte ADD CONSTRAINT FK_7B019081FCF8192D FOREIGN KEY (id_usuario) REFERENCES usuario (id)');
        $this->addSql('ALTER TABLE usuario_soporte ADD CONSTRAINT FK_7B019081DCBA93B6 FOREIGN KEY (id_soporte) REFERENCES soporte (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soporte DROP FOREIGN KEY FK_2273AC616DFFBD3');
        $this->addSql('ALTER TABLE usuario_soporte DROP FOREIGN KEY FK_7B019081FCF8192D');
        $this->addSql('ALTER TABLE usuario_soporte DROP FOREIGN KEY FK_7B019081DCBA93B6');
        $this->addSql('DROP TABLE agente_externo');
        $this->addSql('DROP TABLE soporte');
        $this->addSql('DROP TABLE usuario_soporte');
    }
}
