<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230703210818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'First setup OpenLink';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `LINKS` (`id` int(11) unsigned NOT NULL AUTO_INCREMENT, `original` char(128) NOT NULL, `shorten` char(11) NOT NULL, `creation` int(11) NOT NULL, PRIMARY KEY (`id`))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE links');
    }
}
