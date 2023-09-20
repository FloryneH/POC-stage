<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230920080825 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, date DATE DEFAULT NULL, lieu VARCHAR(255) DEFAULT NULL, media_filename VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category_formation DROP FOREIGN KEY FK_8720F38F5200282E');
        $this->addSql('ALTER TABLE formation_user DROP FOREIGN KEY FK_DA4C33095200282E');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1471C15D5C');
        $this->addSql('DROP TABLE formation');
    }
}
