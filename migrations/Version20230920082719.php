<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230920082719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, date DATE DEFAULT NULL, media_filename VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE formation_user DROP FOREIGN KEY FK_DA4C33095200282E');
        $this->addSql('ALTER TABLE formation_user DROP FOREIGN KEY FK_DA4C3309A76ED395');
        $this->addSql('ALTER TABLE category_formation DROP FOREIGN KEY FK_8720F38F12469DE2');
        $this->addSql('ALTER TABLE category_formation DROP FOREIGN KEY FK_8720F38F5200282E');
        $this->addSql('DROP TABLE formation_user');
        $this->addSql('DROP TABLE category_formation');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1471C15D5C');
        $this->addSql('DROP INDEX IDX_CFBDFA1471C15D5C ON note');
        $this->addSql('ALTER TABLE note DROP id_formation_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formation_user (formation_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_DA4C33095200282E (formation_id), INDEX IDX_DA4C3309A76ED395 (user_id), PRIMARY KEY(formation_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE category_formation (category_id INT NOT NULL, formation_id INT NOT NULL, INDEX IDX_8720F38F12469DE2 (category_id), INDEX IDX_8720F38F5200282E (formation_id), PRIMARY KEY(category_id, formation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE formation_user ADD CONSTRAINT FK_DA4C33095200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_user ADD CONSTRAINT FK_DA4C3309A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_formation ADD CONSTRAINT FK_8720F38F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_formation ADD CONSTRAINT FK_8720F38F5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE formation');
        $this->addSql('ALTER TABLE note ADD id_formation_id INT NOT NULL');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1471C15D5C FOREIGN KEY (id_formation_id) REFERENCES formation (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_CFBDFA1471C15D5C ON note (id_formation_id)');
    }
}
