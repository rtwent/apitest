<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211212160910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE greeting_id_seq CASCADE');
        $this->addSql('CREATE TABLE centers (id UUID NOT NULL, representation_id UUID NOT NULL, group_id UUID NOT NULL, name TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX centersn_uuid_index ON centers (id)');
        $this->addSql('CREATE INDEX centers_representation_index ON centers (representation_id)');
        $this->addSql('CREATE INDEX centers_group_index ON centers (group_id)');
        $this->addSql('COMMENT ON COLUMN centers.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN centers.representation_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN centers.group_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE groups (id UUID NOT NULL, name TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX groups_uuid_index ON groups (id)');
        $this->addSql('COMMENT ON COLUMN groups.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE representations (id UUID NOT NULL, name TEXT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, deleted_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX representation_uuid_index ON representations (id)');
        $this->addSql('COMMENT ON COLUMN representations.id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE centers ADD CONSTRAINT FK_274DDB3146CE82F4 FOREIGN KEY (representation_id) REFERENCES representations (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE centers ADD CONSTRAINT FK_274DDB31FE54D947 FOREIGN KEY (group_id) REFERENCES groups (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE greeting');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE centers DROP CONSTRAINT FK_274DDB31FE54D947');
        $this->addSql('ALTER TABLE centers DROP CONSTRAINT FK_274DDB3146CE82F4');
        $this->addSql('CREATE SEQUENCE greeting_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE greeting (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE centers');
        $this->addSql('DROP TABLE groups');
        $this->addSql('DROP TABLE representations');
    }
}
