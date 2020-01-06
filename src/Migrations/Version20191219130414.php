<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191219130414 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipement ADD panoplie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE equipement ADD CONSTRAINT FK_B8B4C6F3A46E7555 FOREIGN KEY (panoplie_id) REFERENCES panoplie (id)');
        $this->addSql('CREATE INDEX IDX_B8B4C6F3A46E7555 ON equipement (panoplie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE equipement DROP FOREIGN KEY FK_B8B4C6F3A46E7555');
        $this->addSql('DROP INDEX IDX_B8B4C6F3A46E7555 ON equipement');
        $this->addSql('ALTER TABLE equipement DROP panoplie_id');
    }
}
