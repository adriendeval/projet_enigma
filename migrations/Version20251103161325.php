<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251103161325 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `tbl_enigma` (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_A30FBED1B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `tbl_game` (id INT AUTO_INCREMENT NOT NULL, launched_by_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_960B6464B139181F (launched_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `tbl_team` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, creation_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `tbl_user` (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `tbl_enigma` ADD CONSTRAINT FK_A30FBED1B03A8386 FOREIGN KEY (created_by_id) REFERENCES `tbl_user` (id)');
        $this->addSql('ALTER TABLE `tbl_game` ADD CONSTRAINT FK_960B6464B139181F FOREIGN KEY (launched_by_id) REFERENCES `tbl_team` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `tbl_enigma` DROP FOREIGN KEY FK_A30FBED1B03A8386');
        $this->addSql('ALTER TABLE `tbl_game` DROP FOREIGN KEY FK_960B6464B139181F');
        $this->addSql('DROP TABLE `tbl_enigma`');
        $this->addSql('DROP TABLE `tbl_game`');
        $this->addSql('DROP TABLE `tbl_team`');
        $this->addSql('DROP TABLE `tbl_user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
