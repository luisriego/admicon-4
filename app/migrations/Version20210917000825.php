<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210917000825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates `user` table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE user (id CHAR(36) NOT NULL, name VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(100) DEFAULT NULL, avatar VARCHAR(255) DEFAULT NULL, token VARCHAR(64) DEFAULT NULL, active TINYINT(1) NOT NULL, reset_password_token VARCHAR(64) DEFAULT NULL, roles JSON DEFAULT NULL COMMENT \'(DC2Type:json_array)\', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_user_active (active), UNIQUE INDEX U_user_email (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE user');
    }
}