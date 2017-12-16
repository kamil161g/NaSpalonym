<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171213121657 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `match` ADD zaczynamy DATETIME DEFAULT NULL, ADD koniec DATETIME DEFAULT NULL, DROP start_date, DROP finish_date, CHANGE guest gosc VARCHAR(100) DEFAULT NULL, CHANGE guest_goal gosc_goal INT DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE `match` ADD start_date DATETIME DEFAULT NULL, ADD finish_date DATETIME DEFAULT NULL, DROP zaczynamy, DROP koniec, CHANGE gosc guest VARCHAR(100) DEFAULT NULL COLLATE utf8_unicode_ci, CHANGE gosc_goal guest_goal INT DEFAULT NULL');
    }
}
