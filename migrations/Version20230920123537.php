<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230920123537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX `primary` ON article_category');
        $this->addSql('ALTER TABLE article_category DROP FOREIGN KEY FK_C5E24E1812469DE2');
        $this->addSql('ALTER TABLE article_category DROP FOREIGN KEY FK_C5E24E187294869C');
        $this->addSql('ALTER TABLE article_category ADD PRIMARY KEY (article_id, category_id)');
        $this->addSql('DROP INDEX idx_c5e24e187294869c ON article_category');
        $this->addSql('CREATE INDEX IDX_53A4EDAA7294869C ON article_category (article_id)');
        $this->addSql('DROP INDEX idx_c5e24e1812469de2 ON article_category');
        $this->addSql('CREATE INDEX IDX_53A4EDAA12469DE2 ON article_category (category_id)');
        $this->addSql('ALTER TABLE article_category ADD CONSTRAINT FK_C5E24E1812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_category ADD CONSTRAINT FK_C5E24E187294869C FOREIGN KEY (article_id) REFERENCES article (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP INDEX `primary` ON formation_category');
        $this->addSql('ALTER TABLE formation_category DROP FOREIGN KEY FK_8720F38F12469DE2');
        $this->addSql('ALTER TABLE formation_category DROP FOREIGN KEY FK_8720F38F5200282E');
        $this->addSql('ALTER TABLE formation_category ADD PRIMARY KEY (formation_id, category_id)');
        $this->addSql('DROP INDEX idx_8720f38f5200282e ON formation_category');
        $this->addSql('CREATE INDEX IDX_C1DE4E305200282E ON formation_category (formation_id)');
        $this->addSql('DROP INDEX idx_8720f38f12469de2 ON formation_category');
        $this->addSql('CREATE INDEX IDX_C1DE4E3012469DE2 ON formation_category (category_id)');
        $this->addSql('ALTER TABLE formation_category ADD CONSTRAINT FK_8720F38F12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_category ADD CONSTRAINT FK_8720F38F5200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD username VARCHAR(255) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD nom VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP username, DROP prenom, DROP nom');
        $this->addSql('DROP INDEX `PRIMARY` ON formation_category');
        $this->addSql('ALTER TABLE formation_category DROP FOREIGN KEY FK_C1DE4E305200282E');
        $this->addSql('ALTER TABLE formation_category DROP FOREIGN KEY FK_C1DE4E3012469DE2');
        $this->addSql('ALTER TABLE formation_category ADD PRIMARY KEY (category_id, formation_id)');
        $this->addSql('DROP INDEX idx_c1de4e3012469de2 ON formation_category');
        $this->addSql('CREATE INDEX IDX_8720F38F12469DE2 ON formation_category (category_id)');
        $this->addSql('DROP INDEX idx_c1de4e305200282e ON formation_category');
        $this->addSql('CREATE INDEX IDX_8720F38F5200282E ON formation_category (formation_id)');
        $this->addSql('ALTER TABLE formation_category ADD CONSTRAINT FK_C1DE4E305200282E FOREIGN KEY (formation_id) REFERENCES formation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formation_category ADD CONSTRAINT FK_C1DE4E3012469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('DROP INDEX `PRIMARY` ON article_category');
        $this->addSql('ALTER TABLE article_category DROP FOREIGN KEY FK_53A4EDAA7294869C');
        $this->addSql('ALTER TABLE article_category DROP FOREIGN KEY FK_53A4EDAA12469DE2');
        $this->addSql('ALTER TABLE article_category ADD PRIMARY KEY (category_id, article_id)');
        $this->addSql('DROP INDEX idx_53a4edaa12469de2 ON article_category');
        $this->addSql('CREATE INDEX IDX_C5E24E1812469DE2 ON article_category (category_id)');
        $this->addSql('DROP INDEX idx_53a4edaa7294869c ON article_category');
        $this->addSql('CREATE INDEX IDX_C5E24E187294869C ON article_category (article_id)');
        $this->addSql('ALTER TABLE article_category ADD CONSTRAINT FK_53A4EDAA7294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_category ADD CONSTRAINT FK_53A4EDAA12469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
    }
}
