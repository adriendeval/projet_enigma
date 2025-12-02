<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251202204611 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tbl_avatar (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_enigma (id INT AUTO_INCREMENT NOT NULL, type_id INT DEFAULT NULL, position INT DEFAULT NULL, title VARCHAR(255) NOT NULL, instruction LONGTEXT DEFAULT NULL, secret_code VARCHAR(10) DEFAULT NULL, INDEX IDX_A30FBED1C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_game (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, welcome_message LONGTEXT DEFAULT NULL, welcome_image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_setting (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, INDEX IDX_C427B0ECE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_team (id INT AUTO_INCREMENT NOT NULL, avatar_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, position INT DEFAULT NULL, current_enigma INT NOT NULL, note LONGTEXT DEFAULT NULL, INDEX IDX_71C0F3F786383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_thumbnail (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, information LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbl_enigma ADD CONSTRAINT FK_A30FBED1C54C8C93 FOREIGN KEY (type_id) REFERENCES tbl_type (id)');
        $this->addSql('ALTER TABLE tbl_setting ADD CONSTRAINT FK_C427B0ECE48FD905 FOREIGN KEY (game_id) REFERENCES tbl_game (id)');
        $this->addSql('ALTER TABLE tbl_team ADD CONSTRAINT FK_71C0F3F786383B10 FOREIGN KEY (avatar_id) REFERENCES tbl_avatar (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tbl_enigma DROP FOREIGN KEY FK_A30FBED1C54C8C93');
        $this->addSql('ALTER TABLE tbl_setting DROP FOREIGN KEY FK_C427B0ECE48FD905');
        $this->addSql('ALTER TABLE tbl_team DROP FOREIGN KEY FK_71C0F3F786383B10');
        $this->addSql('DROP TABLE tbl_avatar');
        $this->addSql('DROP TABLE tbl_enigma');
        $this->addSql('DROP TABLE tbl_game');
        $this->addSql('DROP TABLE tbl_setting');
        $this->addSql('DROP TABLE tbl_team');
        $this->addSql('DROP TABLE tbl_thumbnail');
        $this->addSql('DROP TABLE tbl_type');
        $this->addSql('DROP TABLE tbl_user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
