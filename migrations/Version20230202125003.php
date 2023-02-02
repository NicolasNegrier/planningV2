<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230202125003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE daily_task_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE daily_task (id INT NOT NULL, day_id INT DEFAULT NULL, task_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1678C4B09C24126 ON daily_task (day_id)');
        $this->addSql('CREATE INDEX IDX_1678C4B08DB60186 ON daily_task (task_id)');
        $this->addSql('CREATE TABLE daily_task_slot (daily_task_id INT NOT NULL, slot_id INT NOT NULL, PRIMARY KEY(daily_task_id, slot_id))');
        $this->addSql('CREATE INDEX IDX_5EB9AD065257D072 ON daily_task_slot (daily_task_id)');
        $this->addSql('CREATE INDEX IDX_5EB9AD0659E5119C ON daily_task_slot (slot_id)');
        $this->addSql('CREATE TABLE daily_task_user (daily_task_id INT NOT NULL, user_id INT NOT NULL, PRIMARY KEY(daily_task_id, user_id))');
        $this->addSql('CREATE INDEX IDX_7F245B285257D072 ON daily_task_user (daily_task_id)');
        $this->addSql('CREATE INDEX IDX_7F245B28A76ED395 ON daily_task_user (user_id)');
        $this->addSql('ALTER TABLE daily_task ADD CONSTRAINT FK_1678C4B09C24126 FOREIGN KEY (day_id) REFERENCES day (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE daily_task ADD CONSTRAINT FK_1678C4B08DB60186 FOREIGN KEY (task_id) REFERENCES task (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE daily_task_slot ADD CONSTRAINT FK_5EB9AD065257D072 FOREIGN KEY (daily_task_id) REFERENCES daily_task (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE daily_task_slot ADD CONSTRAINT FK_5EB9AD0659E5119C FOREIGN KEY (slot_id) REFERENCES slot (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE daily_task_user ADD CONSTRAINT FK_7F245B285257D072 FOREIGN KEY (daily_task_id) REFERENCES daily_task (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE daily_task_user ADD CONSTRAINT FK_7F245B28A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE daily_task_id_seq CASCADE');
        $this->addSql('ALTER TABLE daily_task DROP CONSTRAINT FK_1678C4B09C24126');
        $this->addSql('ALTER TABLE daily_task DROP CONSTRAINT FK_1678C4B08DB60186');
        $this->addSql('ALTER TABLE daily_task_slot DROP CONSTRAINT FK_5EB9AD065257D072');
        $this->addSql('ALTER TABLE daily_task_slot DROP CONSTRAINT FK_5EB9AD0659E5119C');
        $this->addSql('ALTER TABLE daily_task_user DROP CONSTRAINT FK_7F245B285257D072');
        $this->addSql('ALTER TABLE daily_task_user DROP CONSTRAINT FK_7F245B28A76ED395');
        $this->addSql('DROP TABLE daily_task');
        $this->addSql('DROP TABLE daily_task_slot');
        $this->addSql('DROP TABLE daily_task_user');
    }
}
