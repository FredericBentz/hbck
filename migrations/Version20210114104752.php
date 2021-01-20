<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114104752 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_match_handball (user_id INT NOT NULL, match_handball_id INT NOT NULL, INDEX IDX_F6280E19A76ED395 (user_id), INDEX IDX_F6280E19269F6366 (match_handball_id), PRIMARY KEY(user_id, match_handball_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_match_handball ADD CONSTRAINT FK_F6280E19A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_match_handball ADD CONSTRAINT FK_F6280E19269F6366 FOREIGN KEY (match_handball_id) REFERENCES match_handball (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE injury ADD user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE injury ADD CONSTRAINT FK_8A4A592D9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_8A4A592D9D86650F ON injury (user_id_id)');
        $this->addSql('ALTER TABLE match_handball ADD season_id_id INT NOT NULL, ADD league_id_id INT NOT NULL, ADD team_home_id_id INT NOT NULL, ADD team_away_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE match_handball ADD CONSTRAINT FK_9DADD14068756988 FOREIGN KEY (season_id_id) REFERENCES season (id)');
        $this->addSql('ALTER TABLE match_handball ADD CONSTRAINT FK_9DADD1408A97161 FOREIGN KEY (league_id_id) REFERENCES league (id)');
        $this->addSql('ALTER TABLE match_handball ADD CONSTRAINT FK_9DADD1404A671502 FOREIGN KEY (team_home_id_id) REFERENCES team (id)');
        $this->addSql('ALTER TABLE match_handball ADD CONSTRAINT FK_9DADD14056BB3D54 FOREIGN KEY (team_away_id_id) REFERENCES team (id)');
        $this->addSql('CREATE INDEX IDX_9DADD14068756988 ON match_handball (season_id_id)');
        $this->addSql('CREATE INDEX IDX_9DADD1408A97161 ON match_handball (league_id_id)');
        $this->addSql('CREATE INDEX IDX_9DADD1404A671502 ON match_handball (team_home_id_id)');
        $this->addSql('CREATE INDEX IDX_9DADD14056BB3D54 ON match_handball (team_away_id_id)');
        $this->addSql('ALTER TABLE suspended ADD user_id_id INT NOT NULL, ADD match_id_start_id INT DEFAULT NULL, ADD match_id_end_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE suspended ADD CONSTRAINT FK_8A95926F9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE suspended ADD CONSTRAINT FK_8A95926F7F6426 FOREIGN KEY (match_id_start_id) REFERENCES match_handball (id)');
        $this->addSql('ALTER TABLE suspended ADD CONSTRAINT FK_8A95926FDD3B7356 FOREIGN KEY (match_id_end_id) REFERENCES match_handball (id)');
        $this->addSql('CREATE INDEX IDX_8A95926F9D86650F ON suspended (user_id_id)');
        $this->addSql('CREATE INDEX IDX_8A95926F7F6426 ON suspended (match_id_start_id)');
        $this->addSql('CREATE INDEX IDX_8A95926FDD3B7356 ON suspended (match_id_end_id)');
        $this->addSql('ALTER TABLE team ADD category_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE team ADD CONSTRAINT FK_C4E0A61F9777D11E FOREIGN KEY (category_id_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_C4E0A61F9777D11E ON team (category_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_match_handball');
        $this->addSql('ALTER TABLE injury DROP FOREIGN KEY FK_8A4A592D9D86650F');
        $this->addSql('DROP INDEX IDX_8A4A592D9D86650F ON injury');
        $this->addSql('ALTER TABLE injury DROP user_id_id');
        $this->addSql('ALTER TABLE match_handball DROP FOREIGN KEY FK_9DADD14068756988');
        $this->addSql('ALTER TABLE match_handball DROP FOREIGN KEY FK_9DADD1408A97161');
        $this->addSql('ALTER TABLE match_handball DROP FOREIGN KEY FK_9DADD1404A671502');
        $this->addSql('ALTER TABLE match_handball DROP FOREIGN KEY FK_9DADD14056BB3D54');
        $this->addSql('DROP INDEX IDX_9DADD14068756988 ON match_handball');
        $this->addSql('DROP INDEX IDX_9DADD1408A97161 ON match_handball');
        $this->addSql('DROP INDEX IDX_9DADD1404A671502 ON match_handball');
        $this->addSql('DROP INDEX IDX_9DADD14056BB3D54 ON match_handball');
        $this->addSql('ALTER TABLE match_handball DROP season_id_id, DROP league_id_id, DROP team_home_id_id, DROP team_away_id_id');
        $this->addSql('ALTER TABLE suspended DROP FOREIGN KEY FK_8A95926F9D86650F');
        $this->addSql('ALTER TABLE suspended DROP FOREIGN KEY FK_8A95926F7F6426');
        $this->addSql('ALTER TABLE suspended DROP FOREIGN KEY FK_8A95926FDD3B7356');
        $this->addSql('DROP INDEX IDX_8A95926F9D86650F ON suspended');
        $this->addSql('DROP INDEX IDX_8A95926F7F6426 ON suspended');
        $this->addSql('DROP INDEX IDX_8A95926FDD3B7356 ON suspended');
        $this->addSql('ALTER TABLE suspended DROP user_id_id, DROP match_id_start_id, DROP match_id_end_id');
        $this->addSql('ALTER TABLE team DROP FOREIGN KEY FK_C4E0A61F9777D11E');
        $this->addSql('DROP INDEX IDX_C4E0A61F9777D11E ON team');
        $this->addSql('ALTER TABLE team DROP category_id_id');
    }
}
