<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220403160157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE primary_comment ADD image_id BIGINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE primary_comment ADD CONSTRAINT FK_5FED16583DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_5FED16583DA5256D ON primary_comment (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE primary_comment DROP FOREIGN KEY FK_5FED16583DA5256D');
        $this->addSql('DROP INDEX IDX_5FED16583DA5256D ON primary_comment');
        $this->addSql('ALTER TABLE primary_comment DROP image_id');
    }
}
