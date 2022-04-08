<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220403163130 extends AbstractMigration
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
        $this->addSql('ALTER TABLE image ADD album_id BIGINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F1137ABCF FOREIGN KEY (album_id) REFERENCES album (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F1137ABCF ON image (album_id)');
        $this->addSql('ALTER TABLE primary_comment ADD image_id BIGINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE primary_comment ADD CONSTRAINT FK_5FED16583DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_5FED16583DA5256D ON primary_comment (image_id)');
        $this->addSql('ALTER TABLE secondary_comment ADD primary_comment_id BIGINT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE secondary_comment ADD CONSTRAINT FK_516AA4ACC6CD9175 FOREIGN KEY (primary_comment_id) REFERENCES primary_comment (id)');
        $this->addSql('CREATE INDEX IDX_516AA4ACC6CD9175 ON secondary_comment (primary_comment_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE album_tag');
        $this->addSql('DROP TABLE image_tag');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F1137ABCF');
        $this->addSql('DROP INDEX IDX_C53D045F1137ABCF ON image');
        $this->addSql('ALTER TABLE image DROP album_id');
        $this->addSql('ALTER TABLE primary_comment DROP FOREIGN KEY FK_5FED16583DA5256D');
        $this->addSql('DROP INDEX IDX_5FED16583DA5256D ON primary_comment');
        $this->addSql('ALTER TABLE primary_comment DROP image_id');
        $this->addSql('ALTER TABLE secondary_comment DROP FOREIGN KEY FK_516AA4ACC6CD9175');
        $this->addSql('DROP INDEX IDX_516AA4ACC6CD9175 ON secondary_comment');
        $this->addSql('ALTER TABLE secondary_comment DROP primary_comment_id');
    }
}
