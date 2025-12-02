<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251202210500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Update database schema to match new entity requirements: User, Game, Enigma, Team, Type, Thumbnail, Avatar, Setting';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        
        // Drop old tables and foreign keys first
        $this->addSql('ALTER TABLE `tbl_enigma` DROP FOREIGN KEY FK_A30FBED1B03A8386');
        $this->addSql('ALTER TABLE `tbl_game` DROP FOREIGN KEY FK_960B6464B139181F');
        $this->addSql('DROP TABLE `tbl_enigma`');
        $this->addSql('DROP TABLE `tbl_game`');
        $this->addSql('DROP TABLE `tbl_team`');
        
        // Create new Type table
        $this->addSql('CREATE TABLE `tbl_type` (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        // Create new Avatar table
        $this->addSql('CREATE TABLE `tbl_avatar` (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        // Create new Game table with updated structure
        $this->addSql('CREATE TABLE `tbl_game` (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, title VARCHAR(255) NOT NULL, welcome_msg LONGTEXT DEFAULT NULL, welcome_img VARCHAR(255) DEFAULT NULL, INDEX IDX_960B6464A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        // Create new Team table with updated structure
        $this->addSql('CREATE TABLE `tbl_team` (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, avatar_id INT DEFAULT NULL, name VARCHAR(50) NOT NULL, position INT DEFAULT NULL, current_enigma INT DEFAULT NULL, note LONGTEXT DEFAULT NULL, INDEX IDX_4E7B6E46E48FD905 (game_id), INDEX IDX_4E7B6E4686383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        // Create new Enigma table with updated structure
        $this->addSql('CREATE TABLE `tbl_enigma` (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, type_id INT NOT NULL, title VARCHAR(255) NOT NULL, `order` INT NOT NULL, instruction LONGTEXT DEFAULT NULL, secret_code VARCHAR(255) DEFAULT NULL, INDEX IDX_A30FBED1E48FD905 (game_id), INDEX IDX_A30FBED1C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        // Create new Thumbnail table
        $this->addSql('CREATE TABLE `tbl_thumbnail` (id INT AUTO_INCREMENT NOT NULL, enigma_id INT NOT NULL, image VARCHAR(255) NOT NULL, information LONGTEXT DEFAULT NULL, INDEX IDX_F3A7EE47170693D (enigma_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        // Create new Setting table
        $this->addSql('CREATE TABLE `tbl_setting` (id INT AUTO_INCREMENT NOT NULL, game_id INT NOT NULL, UNIQUE INDEX UNIQ_E66C8C6AE48FD905 (game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        // Add is_verified to User table
        $this->addSql('ALTER TABLE `tbl_user` ADD is_verified TINYINT(1) NOT NULL DEFAULT 0');
        
        // Add foreign keys
        $this->addSql('ALTER TABLE `tbl_game` ADD CONSTRAINT FK_960B6464A76ED395 FOREIGN KEY (user_id) REFERENCES `tbl_user` (id)');
        $this->addSql('ALTER TABLE `tbl_team` ADD CONSTRAINT FK_4E7B6E46E48FD905 FOREIGN KEY (game_id) REFERENCES `tbl_game` (id)');
        $this->addSql('ALTER TABLE `tbl_team` ADD CONSTRAINT FK_4E7B6E4686383B10 FOREIGN KEY (avatar_id) REFERENCES `tbl_avatar` (id)');
        $this->addSql('ALTER TABLE `tbl_enigma` ADD CONSTRAINT FK_A30FBED1E48FD905 FOREIGN KEY (game_id) REFERENCES `tbl_game` (id)');
        $this->addSql('ALTER TABLE `tbl_enigma` ADD CONSTRAINT FK_A30FBED1C54C8C93 FOREIGN KEY (type_id) REFERENCES `tbl_type` (id)');
        $this->addSql('ALTER TABLE `tbl_thumbnail` ADD CONSTRAINT FK_F3A7EE47170693D FOREIGN KEY (enigma_id) REFERENCES `tbl_enigma` (id)');
        $this->addSql('ALTER TABLE `tbl_setting` ADD CONSTRAINT FK_E66C8C6AE48FD905 FOREIGN KEY (game_id) REFERENCES `tbl_game` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        
        // Drop foreign keys
        $this->addSql('ALTER TABLE `tbl_game` DROP FOREIGN KEY FK_960B6464A76ED395');
        $this->addSql('ALTER TABLE `tbl_team` DROP FOREIGN KEY FK_4E7B6E46E48FD905');
        $this->addSql('ALTER TABLE `tbl_team` DROP FOREIGN KEY FK_4E7B6E4686383B10');
        $this->addSql('ALTER TABLE `tbl_enigma` DROP FOREIGN KEY FK_A30FBED1E48FD905');
        $this->addSql('ALTER TABLE `tbl_enigma` DROP FOREIGN KEY FK_A30FBED1C54C8C93');
        $this->addSql('ALTER TABLE `tbl_thumbnail` DROP FOREIGN KEY FK_F3A7EE47170693D');
        $this->addSql('ALTER TABLE `tbl_setting` DROP FOREIGN KEY FK_E66C8C6AE48FD905');
        
        // Drop new tables
        $this->addSql('DROP TABLE `tbl_type`');
        $this->addSql('DROP TABLE `tbl_avatar`');
        $this->addSql('DROP TABLE `tbl_thumbnail`');
        $this->addSql('DROP TABLE `tbl_setting`');
        $this->addSql('DROP TABLE `tbl_enigma`');
        $this->addSql('DROP TABLE `tbl_team`');
        $this->addSql('DROP TABLE `tbl_game`');
        
        // Remove is_verified from User table
        $this->addSql('ALTER TABLE `tbl_user` DROP is_verified');
        
        // Recreate old tables
        $this->addSql('CREATE TABLE `tbl_enigma` (id INT AUTO_INCREMENT NOT NULL, created_by_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_A30FBED1B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `tbl_game` (id INT AUTO_INCREMENT NOT NULL, launched_by_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_960B6464B139181F (launched_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `tbl_team` (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, creation_date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `tbl_enigma` ADD CONSTRAINT FK_A30FBED1B03A8386 FOREIGN KEY (created_by_id) REFERENCES `tbl_user` (id)');
        $this->addSql('ALTER TABLE `tbl_game` ADD CONSTRAINT FK_960B6464B139181F FOREIGN KEY (launched_by_id) REFERENCES `tbl_team` (id)');
    }
}
