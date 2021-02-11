<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210210151553 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE injury (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, start DATE DEFAULT NULL, date_end DATE DEFAULT NULL, is_injured TINYINT(1) NOT NULL, INDEX IDX_8A4A592D9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE league (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE match_handball (id INT AUTO_INCREMENT NOT NULL, season_id_id INT NOT NULL, league_id_id INT NOT NULL, team_home_id_id INT NOT NULL, team_away_id_id INT NOT NULL, datetime DATE NOT NULL, score_home INT DEFAULT NULL, score_away INT DEFAULT NULL, INDEX IDX_9DADD14068756988 (season_id_id), INDEX IDX_9DADD1408A97161 (league_id_id), INDEX IDX_9DADD1404A671502 (team_home_id_id), INDEX IDX_9DADD14056BB3D54 (team_away_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE season (id INT AUTO_INCREMENT NOT NULL, start_season DATE NOT NULL, end_season DATE NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE suspended (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, match_id_start_id INT DEFAULT NULL, match_id_end_id INT DEFAULT NULL, nb_game INT NOT NULL, is_suspended TINYINT(1) NOT NULL, INDEX IDX_8A95926F9D86650F (user_id_id), INDEX IDX_8A95926F7F6426 (match_id_start_id), INDEX IDX_8A95926FDD3B7356 (match_id_end_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE team (id INT AUTO_INCREMENT NOT NULL, category_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C4E0A61F9777D11E (category_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, phone VARCHAR(50) NOT NULL, email VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, birthday DATE NOT NULL, password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_role (user_id INT NOT NULL, role_id INT NOT NULL, INDEX IDX_2DE8C6A3A76ED395 (user_id), INDEX IDX_2DE8C6A3D60322AC (role_id), PRIMARY KEY(user_id, role_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_match_handball (user_id INT NOT NULL, match_handball_id INT NOT NULL, INDEX IDX_F6280E19A76ED395 (user_id), INDEX IDX_F6280E19269F6366 (match_handball_id), PRIMARY KEY(user_id, match_handball_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE injury ADD CONSTRAINT FK_8A4A592D9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE match_handball ADD CONSTRAINT FK_9DADD14068756988 FOREIGN KEY (season_id_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE match_handball ADD CONSTRAINT FK_9DADD1408A97161 FOREIGN KEY (league_id_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE match_handball ADD CONSTRAINT FK_9DADD1404A671502 FOREIGN KEY (team_home_id_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE match_handball ADD CONSTRAINT FK_9DADD14056BB3D54 FOREIGN KEY (team_away_id_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE suspended ADD CONSTRAINT FK_8A95926F9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE suspended ADD CONSTRAINT FK_8A95926F7F6426 FOREIGN KEY (match_id_start_id) REFERENCES match_handball (id)');
        $this->addSql('ALTER TABLE suspended ADD CONSTRAINT FK_8A95926FDD3B7356 FOREIGN KEY (match_id_end_id) REFERENCES match_handball (id)');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F9777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_role ADD CONSTRAINT FK_2DE8C6A3D60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_match_handball ADD CONSTRAINT FK_F6280E19A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_match_handball ADD CONSTRAINT FK_F6280E19269F6366 FOREIGN KEY (match_handball_id) REFERENCES match_handball (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F9777D11E');
        $this->addSql('ALTER TABLE match_handball DROP FOREIGN KEY FK_9DADD1408A97161');
        $this->addSql('ALTER TABLE suspended DROP FOREIGN KEY FK_8A95926F7F6426');
        $this->addSql('ALTER TABLE suspended DROP FOREIGN KEY FK_8A95926FDD3B7356');
        $this->addSql('ALTER TABLE user_match_handball DROP FOREIGN KEY FK_F6280E19269F6366');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3D60322AC');
        $this->addSql('ALTER TABLE match_handball DROP FOREIGN KEY FK_9DADD14068756988');
        $this->addSql('ALTER TABLE match_handball DROP FOREIGN KEY FK_9DADD1404A671502');
        $this->addSql('ALTER TABLE match_handball DROP FOREIGN KEY FK_9DADD14056BB3D54');
        $this->addSql('ALTER TABLE injury DROP FOREIGN KEY FK_8A4A592D9D86650F');
        $this->addSql('ALTER TABLE suspended DROP FOREIGN KEY FK_8A95926F9D86650F');
        $this->addSql('ALTER TABLE user_role DROP FOREIGN KEY FK_2DE8C6A3A76ED395');
        $this->addSql('ALTER TABLE user_match_handball DROP FOREIGN KEY FK_F6280E19A76ED395');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE injury');
        $this->addSql('DROP TABLE league');
        $this->addSql('DROP TABLE match_handball');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE season');
        $this->addSql('DROP TABLE suspended');
        $this->addSql('DROP TABLE team');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_role');
        $this->addSql('DROP TABLE user_match_handball');
    }
}
