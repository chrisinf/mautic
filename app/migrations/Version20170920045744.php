<?php

namespace Mautic\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

class Version20170920045744 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE email_log');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE email_log (id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL, sent_at DATETIME DEFAULT \'current_timestamp()\' NOT NULL COMMENT \'(DC2Type:datetime)\', sender TEXT NOT NULL COLLATE latin1_swedish_ci, recipient TEXT NOT NULL COLLATE latin1_swedish_ci, INDEX sent_at (sent_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }
}
