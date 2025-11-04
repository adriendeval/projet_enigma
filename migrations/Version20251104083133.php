<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251104083133 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tbl_enigma (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(50) NOT NULL, question LONGTEXT NOT NULL, data JSON DEFAULT NULL COMMENT \'(DC2Type:json)\', code VARCHAR(20) NOT NULL, position INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enigma_game (enigma_id INT NOT NULL, game_id INT NOT NULL, INDEX IDX_3E216658457B6BA0 (enigma_id), INDEX IDX_3E216658E48FD905 (game_id), PRIMARY KEY(enigma_id, game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_game (id INT AUTO_INCREMENT NOT NULL, team_name VARCHAR(100) NOT NULL, current_index INT NOT NULL, start_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', end_time DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tbl_user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE enigma_game ADD CONSTRAINT FK_3E216658457B6BA0 FOREIGN KEY (enigma_id) REFERENCES tbl_enigma (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enigma_game ADD CONSTRAINT FK_3E216658E48FD905 FOREIGN KEY (game_id) REFERENCES tbl_game (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE enigma_game DROP FOREIGN KEY FK_3E216658457B6BA0');
        $this->addSql('ALTER TABLE enigma_game DROP FOREIGN KEY FK_3E216658E48FD905');
        $this->addSql('DROP TABLE tbl_enigma');
        $this->addSql('DROP TABLE enigma_game');
        $this->addSql('DROP TABLE tbl_game');
        $this->addSql('DROP TABLE tbl_user');
    }
}
