<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113132914 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE day_task (day_id INT NOT NULL, task_id INT NOT NULL, PRIMARY KEY(day_id, task_id))');
        $this->addSql('CREATE INDEX IDX_F91636539C24126 ON day_task (day_id)');
        $this->addSql('CREATE INDEX IDX_F91636538DB60186 ON day_task (task_id)');
        $this->addSql('ALTER TABLE day_task ADD CONSTRAINT FK_F91636539C24126 FOREIGN KEY (day_id) REFERENCES day (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE day_task ADD CONSTRAINT FK_F91636538DB60186 FOREIGN KEY (task_id) REFERENCES task (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE day_task DROP CONSTRAINT FK_F91636539C24126');
        $this->addSql('ALTER TABLE day_task DROP CONSTRAINT FK_F91636538DB60186');
        $this->addSql('DROP TABLE day_task');
    }
}
