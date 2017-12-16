<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171213110325 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `match` CHANGE guest guest VARCHAR(100) DEFAULT NULL, CHANGE start_date start_date DATETIME DEFAULT NULL, CHANGE finish_date finish_date DATETIME DEFAULT NULL, CHANGE guest_goal guest_goal INT DEFAULT NULL, CHANGE gosp_goal gosp_goal INT DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `match` CHANGE guest guest VARCHAR(100) NOT NULL COLLATE utf8_unicode_ci, CHANGE start_date start_date DATETIME NOT NULL, CHANGE finish_date finish_date DATETIME NOT NULL, CHANGE gosp_goal gosp_goal INT NOT NULL, CHANGE guest_goal guest_goal INT NOT NULL');
    }
}
