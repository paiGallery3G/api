<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408014815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album CHANGE title title VARCHAR(64) DEFAULT \'NULL\', CHANGE author author VARCHAR(64) DEFAULT \'NULL\', CHANGE created_at created_at DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE image CHANGE title title VARCHAR(64) DEFAULT \'NULL\', CHANGE ftype ftype VARCHAR(32) DEFAULT \'NULL\', CHANGE author author VARCHAR(64) DEFAULT \'NULL\', CHANGE created_at created_at DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE primary_comment CHANGE title title VARCHAR(64) DEFAULT \'NULL\', CHANGE author author VARCHAR(64) DEFAULT \'NULL\', CHANGE created_at created_at DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE secondary_comment CHANGE title title VARCHAR(64) DEFAULT \'NULL\', CHANGE author author VARCHAR(64) DEFAULT \'NULL\', CHANGE created_at created_at DATE DEFAULT \'NULL\'');
        $this->addSql('ALTER TABLE tag CHANGE title title VARCHAR(64) DEFAULT \'NULL\', CHANGE author author VARCHAR(64) DEFAULT \'NULL\', CHANGE created_at created_at DATE DEFAULT \'NULL\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE album CHANGE title title VARCHAR(64) DEFAULT NULL, CHANGE author author VARCHAR(64) DEFAULT NULL, CHANGE created_at created_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE image CHANGE title title VARCHAR(64) DEFAULT NULL, CHANGE ftype ftype VARCHAR(32) DEFAULT NULL, CHANGE author author VARCHAR(64) DEFAULT NULL, CHANGE created_at created_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE primary_comment CHANGE title title VARCHAR(64) DEFAULT NULL, CHANGE author author VARCHAR(64) DEFAULT NULL, CHANGE created_at created_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE secondary_comment CHANGE title title VARCHAR(64) DEFAULT NULL, CHANGE author author VARCHAR(64) DEFAULT NULL, CHANGE created_at created_at DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE tag CHANGE title title VARCHAR(64) DEFAULT NULL, CHANGE author author VARCHAR(64) DEFAULT NULL, CHANGE created_at created_at DATE DEFAULT NULL');
    }
}
