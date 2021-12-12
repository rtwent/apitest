<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211212161844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO representations ("id", "created_at", "updated_at", "name") VALUES (\'22dfa2fc-8b17-40bf-b9ca-cfca49f1aaf4\', \'2021-04-01 18:17:24\', \'2021-04-01 18:17:24\', \'Representation 1\')');
        $this->addSql('INSERT INTO representations ("id", "created_at", "updated_at", "name") VALUES (\'1f1002fd-1949-44ba-8fbe-27402508bf06\', \'2021-04-01 18:17:24\', \'2021-04-01 18:17:24\', \'Representation 2\')');

        $this->addSql('INSERT INTO groups ("id", "created_at", "updated_at", "name") VALUES (\'2ff1039e-ed29-47ed-865f-d6a41fb643fd\', \'2021-04-01 18:17:24\', \'2021-04-01 18:17:24\', \'Group 1\')');
        $this->addSql('INSERT INTO groups ("id", "created_at", "updated_at", "name") VALUES (\'94e462e0-f872-49a4-9d0b-2591979666f7\', \'2021-04-01 18:17:24\', \'2021-04-01 18:17:24\', \'Group 2\')');

        $this->addSql('INSERT INTO centers ("id", "representation_id", "group_id", "name", "created_at", "updated_at") VALUES (
                                            \'5f550158-07e3-4090-b54b-c522d6d7d146\',
                                            \'22dfa2fc-8b17-40bf-b9ca-cfca49f1aaf4\',
                                            \'94e462e0-f872-49a4-9d0b-2591979666f7\',
                                            \'Center 1\', \'2021-04-01 18:17:24\', \'2021-04-01 18:17:24\')');

        $this->addSql('INSERT INTO centers ("id", "representation_id", "group_id", "name", "created_at", "updated_at") VALUES (
                                            \'0654899b-6232-49be-9568-4d034e6754a8\',
                                            \'1f1002fd-1949-44ba-8fbe-27402508bf06\',
                                            \'94e462e0-f872-49a4-9d0b-2591979666f7\',
                                            \'Center 2\', \'2021-04-01 18:17:24\', \'2021-04-01 18:17:24\')');

        $this->addSql('INSERT INTO centers ("id", "representation_id", "group_id", "name", "created_at", "updated_at") VALUES (
                                            \'434f3ed3-21d7-4fae-acbe-697f3855fe0f\',
                                            \'22dfa2fc-8b17-40bf-b9ca-cfca49f1aaf4\',
                                            \'2ff1039e-ed29-47ed-865f-d6a41fb643fd\',
                                            \'Center 3\', \'2021-04-01 18:17:24\', \'2021-04-01 18:17:24\')');

        $this->addSql('INSERT INTO centers ("id", "representation_id", "group_id", "name", "created_at", "updated_at") VALUES (
                                            \'3fd6e551-d016-449c-b71a-36e14d1cb67d\',
                                            \'1f1002fd-1949-44ba-8fbe-27402508bf06\',
                                            \'2ff1039e-ed29-47ed-865f-d6a41fb643fd\',
                                            \'Center 4\', \'2021-04-01 18:17:24\', \'2021-04-01 18:17:24\')');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
