<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113144408 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_slot (user_id INT NOT NULL, slot_id INT NOT NULL, PRIMARY KEY(user_id, slot_id))');
        $this->addSql('CREATE INDEX IDX_D68F6CAEA76ED395 ON user_slot (user_id)');
        $this->addSql('CREATE INDEX IDX_D68F6CAE59E5119C ON user_slot (slot_id)');
        $this->addSql('ALTER TABLE user_slot ADD CONSTRAINT FK_D68F6CAEA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_slot ADD CONSTRAINT FK_D68F6CAE59E5119C FOREIGN KEY (slot_id) REFERENCES slot (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_slot DROP CONSTRAINT FK_D68F6CAEA76ED395');
        $this->addSql('ALTER TABLE user_slot DROP CONSTRAINT FK_D68F6CAE59E5119C');
        $this->addSql('DROP TABLE user_slot');
    }
}
