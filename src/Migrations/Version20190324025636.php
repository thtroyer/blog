<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190324025636 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE article_article_text DROP FOREIGN KEY FK_58855757845F71FF');
        $this->addSql('DROP TABLE article_article_text');
        $this->addSql('DROP TABLE article_text');
        $this->addSql('ALTER TABLE article ADD text LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE article_article_text (article_id INT NOT NULL, article_text_id INT NOT NULL, INDEX IDX_58855757845F71FF (article_text_id), INDEX IDX_588557577294869C (article_id), PRIMARY KEY(article_id, article_text_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE article_text (id INT AUTO_INCREMENT NOT NULL, text LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, date_created DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE article_article_text ADD CONSTRAINT FK_588557577294869C FOREIGN KEY (article_id) REFERENCES article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article_article_text ADD CONSTRAINT FK_58855757845F71FF FOREIGN KEY (article_text_id) REFERENCES article_text (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article DROP text');
    }
}
