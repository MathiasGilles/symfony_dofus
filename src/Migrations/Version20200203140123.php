<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200203140123 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE element (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE element_spell (element_id INT NOT NULL, spell_id INT NOT NULL, INDEX IDX_141DB9141F1F2A24 (element_id), INDEX IDX_141DB914479EC90D (spell_id), PRIMARY KEY(element_id, spell_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spell (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spell_race (spell_id INT NOT NULL, race_id INT NOT NULL, INDEX IDX_E414EEFE479EC90D (spell_id), INDEX IDX_E414EEFE6E59D40D (race_id), PRIMARY KEY(spell_id, race_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stats_value_per_lvl (id INT AUTO_INCREMENT NOT NULL, attribut_id INT NOT NULL, spell_id INT NOT NULL, value INT NOT NULL, level INT NOT NULL, UNIQUE INDEX UNIQ_FBC1CE9151383AF3 (attribut_id), INDEX IDX_FBC1CE91479EC90D (spell_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE element_spell ADD CONSTRAINT FK_141DB9141F1F2A24 FOREIGN KEY (element_id) REFERENCES element (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE element_spell ADD CONSTRAINT FK_141DB914479EC90D FOREIGN KEY (spell_id) REFERENCES spell (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spell_race ADD CONSTRAINT FK_E414EEFE479EC90D FOREIGN KEY (spell_id) REFERENCES spell (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spell_race ADD CONSTRAINT FK_E414EEFE6E59D40D FOREIGN KEY (race_id) REFERENCES race (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stats_value_per_lvl ADD CONSTRAINT FK_FBC1CE9151383AF3 FOREIGN KEY (attribut_id) REFERENCES attribut (id)');
        $this->addSql('ALTER TABLE stats_value_per_lvl ADD CONSTRAINT FK_FBC1CE91479EC90D FOREIGN KEY (spell_id) REFERENCES spell (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE element_spell DROP FOREIGN KEY FK_141DB9141F1F2A24');
        $this->addSql('ALTER TABLE element_spell DROP FOREIGN KEY FK_141DB914479EC90D');
        $this->addSql('ALTER TABLE spell_race DROP FOREIGN KEY FK_E414EEFE479EC90D');
        $this->addSql('ALTER TABLE stats_value_per_lvl DROP FOREIGN KEY FK_FBC1CE91479EC90D');
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE element_spell');
        $this->addSql('DROP TABLE spell');
        $this->addSql('DROP TABLE spell_race');
        $this->addSql('DROP TABLE stats_value_per_lvl');
    }
}
