<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200301123358 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE spell_element_value (id INT AUTO_INCREMENT NOT NULL, value_min INT DEFAULT NULL, value_max INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE spell_element');
        $this->addSql('ALTER TABLE element ADD value_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E39F920BBA2 FOREIGN KEY (value_id) REFERENCES spell_element_value (id)');
        $this->addSql('CREATE INDEX IDX_41405E39F920BBA2 ON element (value_id)');
        $this->addSql('ALTER TABLE spell ADD value_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE spell ADD CONSTRAINT FK_D03FCD8DF920BBA2 FOREIGN KEY (value_id) REFERENCES spell_element_value (id)');
        $this->addSql('CREATE INDEX IDX_D03FCD8DF920BBA2 ON spell (value_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE element DROP FOREIGN KEY FK_41405E39F920BBA2');
        $this->addSql('ALTER TABLE spell DROP FOREIGN KEY FK_D03FCD8DF920BBA2');
        $this->addSql('CREATE TABLE spell_element (spell_id INT NOT NULL, element_id INT NOT NULL, INDEX IDX_2C251B25479EC90D (spell_id), INDEX IDX_2C251B251F1F2A24 (element_id), PRIMARY KEY(spell_id, element_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE spell_element ADD CONSTRAINT FK_2C251B251F1F2A24 FOREIGN KEY (element_id) REFERENCES element (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spell_element ADD CONSTRAINT FK_2C251B25479EC90D FOREIGN KEY (spell_id) REFERENCES spell (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE spell_element_value');
        $this->addSql('DROP INDEX IDX_41405E39F920BBA2 ON element');
        $this->addSql('ALTER TABLE element DROP value_id');
        $this->addSql('DROP INDEX IDX_D03FCD8DF920BBA2 ON spell');
        $this->addSql('ALTER TABLE spell DROP value_id');
    }
}
