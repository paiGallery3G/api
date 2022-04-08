<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220403154612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album_tag (album_id BIGINT UNSIGNED NOT NULL, tag_id BIGINT UNSIGNED NOT NULL, INDEX IDX_6397379A1137ABCF (album_id), INDEX IDX_6397379ABAD26311 (tag_id), PRIMARY KEY(album_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_tag (image_id BIGINT UNSIGNED NOT NULL, tag_id BIGINT UNSIGNED NOT NULL, INDEX IDX_5B6367D03DA5256D (image_id), INDEX IDX_5B6367D0BAD26311 (tag_id), PRIMARY KEY(image_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE album_tag ADD CONSTRAINT FK_6397379A1137ABCF FOREIGN KEY (album_id) REFERENCES album (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE album_tag ADD CONSTRAINT FK_6397379ABAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_tag ADD CONSTRAINT FK_5B6367D03DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image_tag ADD CONSTRAINT FK_5B6367D0BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE album_tag');
        $this->addSql('DROP TABLE image_tag');
    }
}
