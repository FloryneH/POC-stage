<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230921073838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `primary` ON category_formation');
        $this->addSql('ALTER TABLE category_formation DROP FOREIGN KEY FK_8720F38F12469DE2');
        $this->addSql('ALTER TABLE category_formation DROP FOREIGN KEY FK_8720F38F5200282E');
        $this->addSql('ALTER TABLE category_formation ADD PRIMARY KEY (category_id, formation_id)');
        $this->addSql('DROP INDEX idx_c1de4e3012469de2 ON category_formation');
        $this->addSql('CREATE INDEX IDX_8720F38F12469DE2 ON category_formation (category_id)');
        $this->addSql('DROP INDEX idx_c1de4e305200282e ON category_formation');
        $this->addSql('CREATE INDEX IDX_8720F38F5200282E ON category_formation (formation_id)');
        $this->addSql('ALTER TABLE category_formation ADD CONSTRAINT FK_8720F38F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_formation ADD CONSTRAINT FK_8720F38F5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `PRIMARY` ON category_formation');
        $this->addSql('ALTER TABLE category_formation DROP FOREIGN KEY FK_8720F38F12469DE2');
        $this->addSql('ALTER TABLE category_formation DROP FOREIGN KEY FK_8720F38F5200282E');
        $this->addSql('ALTER TABLE category_formation ADD PRIMARY KEY (formation_id, category_id)');
        $this->addSql('DROP INDEX idx_8720f38f12469de2 ON category_formation');
        $this->addSql('CREATE INDEX IDX_C1DE4E3012469DE2 ON category_formation (category_id)');
        $this->addSql('DROP INDEX idx_8720f38f5200282e ON category_formation');
        $this->addSql('CREATE INDEX IDX_C1DE4E305200282E ON category_formation (formation_id)');
        $this->addSql('ALTER TABLE category_formation ADD CONSTRAINT FK_8720F38F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE category_formation ADD CONSTRAINT FK_8720F38F5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
    }
}
