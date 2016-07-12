<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160711135342 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE home_notes ADD home_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE home_notes ADD CONSTRAINT FK_AE15F1C28CDC89C FOREIGN KEY (home_id) REFERENCES home (id)');
        $this->addSql('CREATE INDEX IDX_AE15F1C28CDC89C ON home_notes (home_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE home_notes DROP FOREIGN KEY FK_AE15F1C28CDC89C');
        $this->addSql('DROP INDEX IDX_AE15F1C28CDC89C ON home_notes');
        $this->addSql('ALTER TABLE home_notes DROP home_id');
    }
}
