<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251202204503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tbl_avatar (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_setting (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, INDEX IDX_C427B0ECE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_thumbnail (id INT AUTO_INCREMENT NOT NULL, image VARCHAR(255) NOT NULL, information LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_type (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tbl_setting ADD CONSTRAINT FK_C427B0ECE48FD905 FOREIGN KEY (game_id) REFERENCES tbl_game (id)');
        $this->addSql('ALTER TABLE tbl_enigma DROP FOREIGN KEY FK_A30FBED1B03A8386');
        $this->addSql('DROP INDEX IDX_A30FBED1B03A8386 ON tbl_enigma');
        $this->addSql('ALTER TABLE tbl_enigma ADD position INT DEFAULT NULL, ADD secret_code VARCHAR(10) DEFAULT NULL, CHANGE created_by_id type_id INT DEFAULT NULL, CHANGE description instruction LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE tbl_enigma ADD CONSTRAINT FK_A30FBED1C54C8C93 FOREIGN KEY (type_id) REFERENCES tbl_type (id)');
        $this->addSql('CREATE INDEX IDX_A30FBED1C54C8C93 ON tbl_enigma (type_id)');
        $this->addSql('ALTER TABLE tbl_game DROP FOREIGN KEY FK_960B6464B139181F');
        $this->addSql('DROP INDEX UNIQ_960B6464B139181F ON tbl_game');
        $this->addSql('ALTER TABLE tbl_game ADD title VARCHAR(100) NOT NULL, ADD welcome_message LONGTEXT DEFAULT NULL, ADD welcome_image VARCHAR(255) DEFAULT NULL, DROP launched_by_id');
        $this->addSql('ALTER TABLE tbl_team ADD avatar_id INT DEFAULT NULL, ADD position INT DEFAULT NULL, ADD current_enigma INT NOT NULL, ADD note LONGTEXT DEFAULT NULL, DROP creation_date');
        $this->addSql('ALTER TABLE tbl_team ADD CONSTRAINT FK_71C0F3F786383B10 FOREIGN KEY (avatar_id) REFERENCES tbl_avatar (id)');
        $this->addSql('CREATE INDEX IDX_71C0F3F786383B10 ON tbl_team (avatar_id)');
        $this->addSql('ALTER TABLE tbl_user ADD is_verified TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tbl_team DROP FOREIGN KEY FK_71C0F3F786383B10');
        $this->addSql('ALTER TABLE tbl_enigma DROP FOREIGN KEY FK_A30FBED1C54C8C93');
        $this->addSql('ALTER TABLE tbl_setting DROP FOREIGN KEY FK_C427B0ECE48FD905');
        $this->addSql('DROP TABLE tbl_avatar');
        $this->addSql('DROP TABLE tbl_setting');
        $this->addSql('DROP TABLE tbl_thumbnail');
        $this->addSql('DROP TABLE tbl_type');
        $this->addSql('DROP INDEX IDX_A30FBED1C54C8C93 ON tbl_enigma');
        $this->addSql('ALTER TABLE tbl_enigma ADD created_by_id INT DEFAULT NULL, DROP type_id, DROP position, DROP secret_code, CHANGE instruction description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE tbl_enigma ADD CONSTRAINT FK_A30FBED1B03A8386 FOREIGN KEY (created_by_id) REFERENCES tbl_user (id)');
        $this->addSql('CREATE INDEX IDX_A30FBED1B03A8386 ON tbl_enigma (created_by_id)');
        $this->addSql('ALTER TABLE tbl_game ADD launched_by_id INT DEFAULT NULL, DROP title, DROP welcome_message, DROP welcome_image');
        $this->addSql('ALTER TABLE tbl_game ADD CONSTRAINT FK_960B6464B139181F FOREIGN KEY (launched_by_id) REFERENCES tbl_team (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_960B6464B139181F ON tbl_game (launched_by_id)');
        $this->addSql('DROP INDEX IDX_71C0F3F786383B10 ON tbl_team');
        $this->addSql('ALTER TABLE tbl_team ADD creation_date DATETIME NOT NULL, DROP avatar_id, DROP position, DROP current_enigma, DROP note');
        $this->addSql('ALTER TABLE tbl_user DROP is_verified');
    }
}
