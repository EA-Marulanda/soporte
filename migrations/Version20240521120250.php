<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240521120250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59FD60322AC');
        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59FA76ED395');
        $this->addSql('CREATE TABLE rol (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(55) NOT NULL, UNIQUE INDEX UNIQ_E553F375E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE usuario (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(80) NOT NULL, usuario VARCHAR(55) NOT NULL, contrasena VARCHAR(255) NOT NULL, tiene_captcha TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_2265B05D2265B05D (usuario), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP INDEX IDX_54FCD59FA76ED395 ON user_roles');
        $this->addSql('DROP INDEX IDX_54FCD59FD60322AC ON user_roles');
        $this->addSql('DROP INDEX `primary` ON user_roles');
        $this->addSql('ALTER TABLE user_roles ADD usuario_id INT NOT NULL, ADD rol_id INT NOT NULL, DROP user_id, DROP role_id');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59FDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59F4BAB96C FOREIGN KEY (rol_id) REFERENCES rol (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_54FCD59FDB38439E ON user_roles (usuario_id)');
        $this->addSql('CREATE INDEX IDX_54FCD59F4BAB96C ON user_roles (rol_id)');
        $this->addSql('ALTER TABLE user_roles ADD PRIMARY KEY (usuario_id, rol_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59F4BAB96C');
        $this->addSql('ALTER TABLE user_roles DROP FOREIGN KEY FK_54FCD59FDB38439E');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(55) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_B63E2EC75E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(55) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_1483A5E9F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE rol');
        $this->addSql('DROP TABLE usuario');
        $this->addSql('DROP INDEX IDX_54FCD59FDB38439E ON user_roles');
        $this->addSql('DROP INDEX IDX_54FCD59F4BAB96C ON user_roles');
        $this->addSql('DROP INDEX `PRIMARY` ON user_roles');
        $this->addSql('ALTER TABLE user_roles ADD user_id INT NOT NULL, ADD role_id INT NOT NULL, DROP usuario_id, DROP rol_id');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59FA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_roles ADD CONSTRAINT FK_54FCD59FD60322AC FOREIGN KEY (role_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_54FCD59FA76ED395 ON user_roles (user_id)');
        $this->addSql('CREATE INDEX IDX_54FCD59FD60322AC ON user_roles (role_id)');
        $this->addSql('ALTER TABLE user_roles ADD PRIMARY KEY (user_id, role_id)');
    }
}
